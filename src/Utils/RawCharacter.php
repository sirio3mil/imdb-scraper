<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 30/05/2018
 * Time: 22:43
 */

namespace ImdbScraper\Utils;


trait RawCharacter
{

    protected $character;

    protected $alias;

    protected $rawCharacter;

    protected $isRawCharacterCleaned;

    /**
     * @return bool
     */
    public function getIsRawCharacterCleaned(): ?bool
    {
        return $this->isRawCharacterCleaned;
    }

    /**
     * @return string
     */
    public function getRawCharacter(): ?string
    {
        return $this->rawCharacter;
    }

    /**
     * @return string
     */
    public function getCharacter(): ?string
    {
        if (!$this->getIsRawCharacterCleaned()) {
            $this->cleanRawCharacter();
        }
        return $this->character;
    }

    /**
     * @return string
     */
    public function getAlias(): ?string
    {
        if (!$this->getIsRawCharacterCleaned()) {
            $this->cleanRawCharacter();
        }
        return $this->alias;
    }

    /**
     * @param bool $isRawCharacterCleaned
     * @return RawCharacter
     */
    public function setIsRawCharacterCleaned(bool $isRawCharacterCleaned): RawCharacter
    {
        $this->isRawCharacterCleaned = $isRawCharacterCleaned;
        return $this;
    }

    /**
     * @param mixed $rawCharacter
     * @return RawCharacter
     */
    public function setRawCharacter(string $rawCharacter): RawCharacter
    {
        $this->rawCharacter = $rawCharacter;
        return $this;
    }

    /**
     * @param string $character
     * @return RawCharacter
     */
    public function setCharacter(string $character): RawCharacter
    {
        $this->character = $character;
        return $this;
    }

    /**
     * @param string $alias
     * @return RawCharacter
     */
    public function setAlias(string $alias): RawCharacter
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanEpisode(string $rawData): RawCharacter
    {
        if (stripos($rawData, "episode") !== false) {
            $words = explode(" ", $rawData);
            $episodeNumberExist = false;
            foreach ($words as $word) {
                if (filter_var($word, FILTER_VALIDATE_INT)) {
                    if ($word > 1) {
                        if ($word < 1700) {
                            $this->replaceInRawCharacter($rawData, "$word episodios");
                            $episodeNumberExist = true;
                        }
                    } else {
                        $this->replaceInRawCharacter($rawData, "$word episodio");
                        $episodeNumberExist = true;
                    }
                    break;
                }
            }
            if (!$episodeNumberExist) {
                $this->replaceInRawCharacter("($rawData)", "");
            }
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanVoice(string $rawData): RawCharacter
    {
        if (stripos($rawData, "voice") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(voz)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanUncredited(string $rawData): RawCharacter
    {
        if (stripos($rawData, "uncredited") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(sin acreditar)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanArchiveFootage(string $rawData): RawCharacter
    {
        if (stripos($rawData, "archive footage") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(tomas de archivo)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanUnconfirmed(string $rawData): RawCharacter
    {
        if (stripos($rawData, "unconfirmed") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(sin confirmar)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanCredited(string $rawData): RawCharacter
    {
        if (stripos($rawData, "credited") !== false) {
            $this->replaceInRawCharacter("($rawData)", "");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanScenesDeleted(string $rawData): RawCharacter
    {
        if (stripos($rawData, "scenes deleted") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(escenas eliminadas)");
        }
        return $this;
    }

    /**
     * @return RawCharacter
     */
    protected function replaceAdditionalTexts(): RawCharacter
    {
        $replacements = [
            'Herself' => 'ella misma',
            'Himself' => 'él mismo',
            ' at ' => ' en ',
            '(at ' => '(en'
        ];
        foreach ($replacements as $target => $replacement) {
            $this->replaceInRawCharacter($target, $replacement);
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return RawCharacter
     */
    protected function cleanRawAlias(string $rawData): RawCharacter
    {
        if (stripos($rawData, "as ") === 0) {
            $this->replaceInRawCharacter("($rawData)", "");
            $this->setAlias(trim(str_replace("as ", "", $rawData)));
        }
        return $this;
    }

    /**
     * @param string $target
     * @param string $replacement
     * @return RawCharacter
     */
    protected function replaceInRawCharacter(string $target, string $replacement): RawCharacter
    {
        return $this->setRawCharacter(str_ireplace($target, $replacement, $this->getRawCharacter()));
    }

    /**
     * @return RawCharacter
     */
    protected function cleanRawCharacter(): RawCharacter
    {
        $this->setIsRawCharacterCleaned(true)
            ->setRawCharacter(trim(strip_tags($this->getRawCharacter())))
            ->replaceAdditionalTexts();
        $matches = [];
        preg_match_all('/\(([^\)]+)\)/', $this->getRawCharacter(), $matches);
        if ($matches) {
            array_shift($matches);
            foreach ($matches as $parts) {
                foreach ($parts as $data) {
                    $this->cleanEpisode($data)
                        ->cleanVoice($data)
                        ->cleanUncredited($data)
                        ->cleanArchiveFootage($data)
                        ->cleanUnconfirmed($data)
                        ->cleanCredited($data)
                        ->cleanScenesDeleted($data)
                        ->cleanRawAlias($data);
                }
            }
        }
        return $this;
    }
}
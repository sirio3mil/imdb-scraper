<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 30/05/2018
 * Time: 22:43
 */

namespace ImdbScraper\Model;

trait RawCharacter
{

    protected $character;

    protected $alias;

    protected $rawCharacter;

    protected $isRawCharacterCleaned;

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
     * @param string $character
     * @return CastPeople
     */
    public function setCharacter(string $character): CastPeople
    {
        $this->character = $character;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsRawCharacterCleaned(): ?bool
    {
        return $this->isRawCharacterCleaned;
    }

    /**
     * @param bool $isRawCharacterCleaned
     * @return CastPeople
     */
    public function setIsRawCharacterCleaned(bool $isRawCharacterCleaned): CastPeople
    {
        $this->isRawCharacterCleaned = $isRawCharacterCleaned;
        return $this;
    }

    /**
     * @return CastPeople
     */
    protected function cleanRawCharacter(): CastPeople
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

    /**
     * @return CastPeople
     */
    protected function replaceAdditionalTexts(): CastPeople
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
     * @param string $target
     * @param string $replacement
     * @return CastPeople
     */
    protected function replaceInRawCharacter(string $target, string $replacement): CastPeople
    {
        return $this->setRawCharacter(str_ireplace($target, $replacement, $this->getRawCharacter()));
    }

    /**
     * @return string
     */
    public function getRawCharacter(): ?string
    {
        return $this->rawCharacter;
    }

    /**
     * @param mixed $rawCharacter
     * @return CastPeople
     */
    public function setRawCharacter(string $rawCharacter): CastPeople
    {
        $this->rawCharacter = $rawCharacter;
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanRawAlias(string $rawData): CastPeople
    {
        if (stripos($rawData, "as ") === 0) {
            $this->replaceInRawCharacter("($rawData)", "");
            $this->setAlias(trim(str_replace("as ", "", $rawData)));
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanScenesDeleted(string $rawData): CastPeople
    {
        if (stripos($rawData, "scenes deleted") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(escenas eliminadas)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanCredited(string $rawData): CastPeople
    {
        if (stripos($rawData, "credited") !== false) {
            $this->replaceInRawCharacter("($rawData)", "");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanUnconfirmed(string $rawData): CastPeople
    {
        if (stripos($rawData, "unconfirmed") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(sin confirmar)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanArchiveFootage(string $rawData): CastPeople
    {
        if (stripos($rawData, "archive footage") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(tomas de archivo)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanUncredited(string $rawData): CastPeople
    {
        if (stripos($rawData, "uncredited") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(sin acreditar)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanVoice(string $rawData): CastPeople
    {
        if (stripos($rawData, "voice") !== false) {
            $this->replaceInRawCharacter("($rawData)", "(voz)");
        }
        return $this;
    }

    /**
     * @param string $rawData
     * @return CastPeople
     */
    protected function cleanEpisode(string $rawData): CastPeople
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
     * @param string $alias
     * @return CastPeople
     */
    public function setAlias(string $alias): CastPeople
    {
        $this->alias = $alias;
        return $this;
    }
}
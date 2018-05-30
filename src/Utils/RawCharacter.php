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

    protected $parenthesisData;

    protected $rawCharacter;

    /**
     * @return string
     */
    public function getRawCharacter(): ?string
    {
        return $this->rawCharacter;
    }

    /**
     * @return array
     */
    public function getParenthesisData(): ?array
    {
        return $this->parenthesisData;
    }

    /**
     * @return string
     */
    public function getCharacter(): ?string
    {
        return $this->character;
    }

    /**
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
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
     * @param mixed $parenthesisData
     * @return RawCharacter
     */
    public function setParenthesisData(array $parenthesisData): RawCharacter
    {
        $this->parenthesisData = $parenthesisData;
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

    protected function cleanRawCharacterEpisodeData()
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "episode") !== false) {
                        $numeros = explode(" ", $dato);
                        $hay_numero = false;
                        foreach ($numeros as $numero) {
                            if (is_numeric($numero)) {
                                if ($numero > 1) {
                                    if ($numero < 1700) {
                                        $resultado = str_replace($dato, "$numero episodios", $resultado);
                                        $hay_numero = true;
                                    }
                                } else {
                                    $resultado = str_replace($dato, "$numero episodio", $resultado);
                                    $hay_numero = true;
                                }
                                break;
                            }
                        }
                        if (!$hay_numero) {
                            $resultado = str_replace(" ($dato)", "", $resultado);
                            $resultado = str_replace("($dato)", "", $resultado);
                        }
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterVoice(string $rawData): RawCharacter
    {
        if (stripos($rawData, "voice") !== false) {
            $this->replaceRawCharacter("($rawData)", "(voz)");
        }
        return $this;
    }

    protected function cleanRawCharacterUncredited(string $rawData): RawCharacter
    {
        if (stripos($rawData, "uncredited") !== false) {
            $this->replaceRawCharacter("($rawData)", "(sin acreditar)");
        }
        return $this;
    }

    protected function cleanRawCharacterArchiveFootage(string $rawData): RawCharacter
    {
        if (stripos($rawData, "archive footage") !== false) {
            $this->replaceRawCharacter("($rawData)", "(tomas de archivo)");
        }
        return $this;
    }

    protected function cleanRawCharacterUnconfirmed(string $rawData): RawCharacter
    {
        if (stripos($rawData, "unconfirmed") !== false) {
            $this->replaceRawCharacter("($rawData)", "(sin confirmar)");
        }
        return $this;
    }

    protected function cleanRawCharacterCredited(string $rawData): RawCharacter
    {
        if (stripos($rawData, "credited") !== false) {
            $this->replaceRawCharacter("($rawData)", "");
        }
        return $this;
    }

    protected function cleanRawCharacterScenesDeleted(string $rawData): RawCharacter
    {
        if (stripos($rawData, "scenes deleted") !== false) {
            $this->replaceRawCharacter("($rawData)", "(escenas eliminadas)");
        }
        return $this;
    }

    protected function cleanRawCharacterSelf(): RawCharacter
    {
        $replacements = [
            'Herself' => 'ella misma',
            'Himself' => 'él mismo',
            ' at '    => ' en ',
            '(at '    => '(en'
        ];
        foreach ($replacements as $target => $replacement) {
            $this->replaceRawCharacter($target, $replacement);
        }
        return $this;
    }

    public function cleanRawAlias(string $rawData): RawCharacter
    {
        if (stripos($rawData, "as ") === 0) {
            $this->replaceRawCharacter("($rawData)", "");
            $this->setAlias(trim(str_replace("as ", "", $rawData)));
        }
        return $this;
    }

    public function replaceRawCharacter(string $target, string $replacement): RawCharacter
    {
        return $this->setRawCharacter(str_ireplace($target, $replacement, $this->getRawCharacter()));
    }

    /**
     * @return RawCharacter
     */
    public function cleanRawCharacter(): RawCharacter
    {
        $matches = [];
        preg_match_all('/\(([^\)]+)\)/', $this->getRawCharacter(), $matches);
        if (!empty($matches)) {
            array_shift($matches);
            foreach ($matches as $parts) {
                foreach ($parts as $data) {
                    if (stripos($data, 'episode') !== false) {
                        $this->cleanRawCharacterEpisodeData($data);
                    }
                    if (stripos($data, 'voice') !== false) {
                        $this->cleanRawCharacterVoice($data);
                    }
                    if (stripos($data, 'uncredited') !== false) {
                        $this->cleanRawCharacterUncredited($data);
                    }
                    if (stripos($data, 'archive footage') !== false) {
                        $this->cleanRawCharacterArchiveFootage($data);
                    }
                    if (stripos($data, 'unconfirmed') !== false) {
                        $this->cleanRawCharacterUnconfirmed($data);
                    }
                    if (stripos($data, 'credited') !== false) {
                        $this->cleanRawCharacterCredited($data);
                    }
                    if (stripos($data, 'scenes deleted') !== false) {
                        $this->cleanRawCharacterScenesDeleted($data);
                    }
                    $this->cleanRawCharacterSelf();
                    $this->cleanRawAlias($data);
                }
            }
        }
        return $this;
    }
}
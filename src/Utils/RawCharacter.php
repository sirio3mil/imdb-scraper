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
                    } elseif (stripos($dato, "voice") !== false) {
                        $resultado = str_replace(" ($dato)", " (voz)", $resultado);
                        $resultado = str_replace("($dato)", "(voz)", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterVoice(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "voice") !== false) {
                        $resultado = str_replace(" ($dato)", " (voz)", $resultado);
                        $resultado = str_replace("($dato)", "(voz)", $resultado);
                    } elseif (stripos($dato, "uncredited") !== false) {
                        $resultado = str_replace(" ($dato)", " (sin acreditar)", $resultado);
                        $resultado = str_replace("($dato)", "(sin acreditar)", $resultado);
                    } elseif (stripos($dato, "as ") !== false) {
                        $resultado = str_replace("(as ", "(como ", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterUncredited(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "uncredited") !== false) {
                        $resultado = str_replace(" ($dato)", " (sin acreditar)", $resultado);
                        $resultado = str_replace("($dato)", "(sin acreditar)", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterArchiveFootage(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "archive footage") !== false) {
                        $resultado = str_replace(" ($dato)", " (tomas de archivo)", $resultado);
                        $resultado = str_replace("($dato)", "(tomas de archivo)", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterUnconfirmed(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "unconfirmed") !== false) {
                        $resultado = str_replace(" ($dato)", " (sin confirmar)", $resultado);
                        $resultado = str_replace("($dato)", "(sin confirmar)", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterCredited(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "credited") !== false) {
                        $resultado = str_replace(" ($dato)", "", $resultado);
                        $resultado = str_replace("($dato)", "", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterScenesDeleted(string $rawData)
    {
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "scenes deleted") !== false) {
                        $resultado = str_replace(" ($dato)", " (escenas eliminadas)", $resultado);
                        $resultado = str_replace("($dato)", "(escenas eliminadas)", $resultado);
                    }
                }
            }
        }
    }

    protected function cleanRawCharacterSelf(string $rawData)
    {
        $replacements = [
            'Herself' => 'ella misma',
            'Himself' => 'él mismo',
            ' at '    => ' en ',
            '(at '    => '(en'
        ];
        foreach ($replacements as $target => $replacement) {
            $rawData = str_ireplace($target, $replacement, $rawData);
        }
        return $rawData;
    }

    public function cleanRawAlias(string $rawData)
    {
                    if (stripos($rawData, "as ") === 0) {
                        $resultado = str_replace(" ($dato)", "", $this->getRawCharacter());
                        $resultado = str_replace("($dato)", "", $resultado);
                        $nombre = trim(str_replace("como ", "", $dato));
                        break;
                    }
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
                    if (stripos($data, 'himself') !== false || stripos($data, 'herself') !== false) {
                        $this->cleanRawCharacterSelf($data);
                    }
                    if (stripos($data, 'as ') !== false) {
                        $this->cleanRawAlias($data);
                    }
                }
            }
        }
        return $this;
    }
}
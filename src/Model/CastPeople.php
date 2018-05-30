<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 28/05/2018
 * Time: 17:06
 */

namespace ImdbScraper\Model;


class CastPeople extends People
{
    protected $character;

    protected $alias;

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
     * @param string $character
     * @return CastPeople
     */
    public function setCharacter(string $character): CastPeople
    {
        $this->character = $character;
        return $this;
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

    /**
     * @param string $rawData
     * @return CastPeople
     */
    public function setRawCharacter(string $rawData): CastPeople
    {
        $rawData = trim(strip_tags($rawData));
        $this->setCharacter($rawData);
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
        $coincidencias = [];
        preg_match_all('/\(([^\)]+)\)/', $rawData, $coincidencias);
        if (!empty($coincidencias)) {
            array_shift($coincidencias);
            foreach ($coincidencias as $partes) {
                foreach ($partes as $dato) {
                    if (stripos($dato, "como ") === 0) {
                        $resultado = str_replace(" ($dato)", "", $resultado);
                        $resultado = str_replace("($dato)", "", $resultado);
                        $nombre = trim(str_replace("como ", "", $dato));
                        break;
                    }
                }
            }
        }
    }

    public function cleanRawCharacter(string $rawData)
    {
        if (stripos($rawData, 'episode') !== false) {
            $rawData = $this->cleanRawCharacterEpisodeData($rawData);
        }
        if (stripos($rawData, 'voice') !== false) {
            $rawData = $this->cleanRawCharacterVoice($rawData);
        }
        if (stripos($rawData, 'uncredited') !== false) {
            $rawData = $this->cleanRawCharacterUncredited($rawData);
        }
        if (stripos($rawData, 'archive footage') !== false) {
            $rawData = $this->cleanRawCharacterArchiveFootage($rawData);
        }
        if (stripos($rawData, 'unconfirmed') !== false) {
            $rawData = $this->cleanRawCharacterUnconfirmed($rawData);
        }
        if (stripos($rawData, 'credited') !== false) {
            $rawData = $this->cleanRawCharacterCredited($rawData);
        }
        if (stripos($rawData, 'scenes deleted') !== false) {
            $rawData = $this->cleanRawCharacterScenesDeleted($rawData);
        }
        if (stripos($rawData, 'himself') !== false || stripos($rawData, 'herself') !== false) {
            $rawData = $this->cleanRawCharacterSelf($rawData);
        }
        if (stripos($rawData, 'as ') !== false) {
            $rawData = $this->cleanRawAlias($rawData);
        }
        return $rawData;
    }
}
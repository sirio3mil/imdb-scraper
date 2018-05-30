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

    /**
     * @return string
     */
    public function getCharacter(): ?string
    {
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
     * @param string $rawData
     * @return CastPeople
     */
    public function setRawCharacter(string $rawData): CastPeople
    {
        $rawData = trim(strip_tags($rawData));
        $this->setCharacter($rawData);
        return $this;
    }

    protected function cleanRawCharacterEpisodeData(){
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%episode%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "episode") !== FALSE){
                            $numeros = explode(" ", $dato);
                            $hay_numero = false;
                            foreach ($numeros as $numero){
                                if(is_numeric($numero)){
                                    if($numero > 1){
                                        if($numero < 1700){
                                            $resultado = str_replace($dato, "$numero episodios", $resultado);
                                            $hay_numero = true;
                                        }
                                    }
                                    else{
                                        $resultado = str_replace($dato, "$numero episodio", $resultado);
                                        $hay_numero = true;
                                    }
                                    break;
                                }
                            }
                            if(!$hay_numero){
                                $resultado = str_replace(" ($dato)", "", $resultado);
                                $resultado = str_replace("($dato)", "", $resultado);
                            }
                        }
                        elseif(stripos($dato, "voice") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (voz)", $resultado);
                            $resultado = str_replace("($dato)", "(voz)", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
    }

    protected function cleanRawCharacterVoice(string $rawData)
    {
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "voice") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (voz)", $resultado);
                            $resultado = str_replace("($dato)", "(voz)", $resultado);
                        }
                        elseif(stripos($dato, "uncredited") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (sin acreditar)", $resultado);
                            $resultado = str_replace("($dato)", "(sin acreditar)", $resultado);
                        }
                        elseif(stripos($dato, "as ") !== FALSE){
                            $resultado = str_replace("(as ", "(como ", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
    }

    protected function

    public function cleanRawCharacter(string $rawData)
    {
        if(stripos($rawData, 'episode') !== false){
            $rawData = $this->cleanRawCharacterEpisodeData();
        }
        if(stripos($rawData, 'voice') !== false){
            $rawData = $this->cleanRawCharacterVoice();
        }

        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%uncredited%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "uncredited") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (sin acreditar)", $resultado);
                            $resultado = str_replace("($dato)", "(sin acreditar)", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (uncredited)</div>";
        }
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%archive footage%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "archive footage") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (tomas de archivo)", $resultado);
                            $resultado = str_replace("($dato)", "(tomas de archivo)", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (archive footage)</div>";
        }
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%unconfirmed%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "unconfirmed") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (sin confirmar)", $resultado);
                            $resultado = str_replace("($dato)", "(sin confirmar)", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (unconfirmed)</div>";
        }
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%credited%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "credited") !== FALSE){
                            $resultado = str_replace(" ($dato)", "", $resultado);
                            $resultado = str_replace("($dato)", "", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (credited)</div>";
        }
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%scenes deleted%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "scenes deleted") !== FALSE){
                            $resultado = str_replace(" ($dato)", " (escenas eliminadas)", $resultado);
                            $resultado = str_replace("($dato)", "(escenas eliminadas)", $resultado);
                        }
                    }
                }
            }
            $stmt->execute();
            $actualizadas += $stmt->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (scenes deleted)</div>";
        }
        $stmt->close();
        $query = "UPDATE filmes_miembros_reparto SET personaje = NULL WHERE personaje LIKE 'himself' or personaje LIKE 'herself'";
        $result = $mysqli->query($query);
        if($mysqli->affected_rows){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>{$mysqli->affected_rows} personajes actualizados (self exact)</div>";
        }
        $actualizadas = 0;
        $queries = array();
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself (', '(') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself,', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself - as', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself -', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself-', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself/', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, '/Herself', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, ' / Herself', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself:', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself &', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself /', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Herself  ', '') WHERE personaje LIKE '%Herself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself (', '(') WHERE personaje LIKE 'Himself (%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself,', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself - as', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself as', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself -', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself-', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself/', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, '/Himself', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, ' / Himself', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself:', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself &', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself /', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, 'Himself  ', '') WHERE personaje LIKE '%Himself%'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, '(as ', '(como ') WHERE personaje LIKE '%(as %'";
        $queries[] = "UPDATE filmes_miembros_reparto SET personaje = REPLACE(personaje, '(at ', '(en ') WHERE personaje LIKE '%(at %'";
        foreach($queries as $query){
            $mysqli->query($query);
            $actualizadas += $mysqli->affected_rows;
        }
        if($actualizadas){
            echo "<div class='alert alert-success margin-bottom-10' role='alert'>$actualizadas personajes actualizados (self)</div>";
        }
        $stmt = $mysqli->prepare("UPDATE filmes_miembros_reparto SET alias = ?, personaje = ? WHERE id = ?");
        if(!$stmt){
            throw new Exception($mysqli->error);
        }
        $filmes_miembros_reparto = 0;
        $resultado = null;
        $nombre = null;
        $stmt->bind_param("ssi", $nombre, $resultado, $filmes_miembros_reparto);
        $query = "SELECT id,personaje FROM filmes_miembros_reparto WHERE personaje LIKE '%(como%'";
        $result = $mysqli->query($query);
        $actualizadas = 0;
        while($row = $result->fetch_object()){
            $filmes_miembros_reparto = $row->id;
            $resultado = $row->personaje;
            $coincidencias = array();
            preg_match_all('/\(([^\)]+)\)/', $row->personaje, $coincidencias);
            if(!empty($coincidencias)){
                array_shift($coincidencias);
                foreach ($coincidencias as $partes){
                    foreach ($partes as $dato){
                        if(stripos($dato, "como ") === 0){
                            $resultado = str_replace(" ($dato)", "", $resultado);
                            $resultado = str_replace("($dato)", "", $resultado);
                            $nombre = trim(str_replace("como ", "", $dato));
                            $stmt->execute();
                            $actualizadas += $stmt->affected_rows;
                            break;
                        }
                    }
                }
            }
        }
    }
}
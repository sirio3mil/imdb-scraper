<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 28/05/2018
 * Time: 17:06
 */

namespace ImdbScraper\Model;


use ImdbScraper\Utils\RawCharacter;

class CastPeople extends People
{
    use RawCharacter;

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
}
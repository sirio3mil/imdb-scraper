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
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setRawCharacter($rawData[5][$position])
            ->setFullName($rawData[3][$position])
            ->setImdbNumber(intval($rawData[1][$position]));
    }
}
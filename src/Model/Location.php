<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 12:53
 */

namespace ImdbScraper\Model;


class Location implements RegexMatchRawData
{

    use VoteParser;

    /** @var string */
    protected const VOTES_PATTERN = '|([0-9]+) of ([0-9]+) found this interesting|U';

    /** @var string */
    protected $location;

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Location
     */
    public function setLocation(string $location): Location
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setLocation($rawData[2][$position])
            ->parseVotes($rawData[5][$position]);
    }
}
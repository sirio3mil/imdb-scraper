<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 12:06
 */

namespace ImdbScraper\Model;


class Keyword implements RegexMatchRawData
{

    use VoteParser;

    /** @var string */
    protected const VOTES_PATTERN = '|([0-9]+) of ([0-9]+) found this relevant|U';

    /** @var string */
    protected $url;

    /** @var string */
    protected $keyword;

    /** @var int */
    protected $imdbNumber;

    /**
     * @return int
     */
    public function getImdbNumber(): int
    {
        return $this->imdbNumber;
    }

    /**
     * @param int $imdbNumber
     * @return Keyword
     */
    public function setImdbNumber(int $imdbNumber): Keyword
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     * @return Keyword
     */
    public function setKeyword(string $keyword): Keyword
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Keyword
     */
    public function setUrl(string $url): Keyword
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setUrl($rawData[1][$position])
            ->setKeyword($rawData[3][$position])
            ->setImdbNumber(intval($rawData[4][$position]))
            ->parseVotes($rawData[5][$position]);
    }
}
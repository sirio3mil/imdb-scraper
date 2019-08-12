<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 14:13
 */

namespace ImdbScraper\Model;


class Episode implements RegexMatchRawData
{

    use DateParser;

    /** @var int */
    protected $episodeNumber;

    /** @var int */
    protected $imdbNumber;

    /** @var string */
    protected $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Episode
     */
    public function setTitle(string $title): Episode
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }

    /**
     * @param int $episodeNumber
     * @return Episode
     */
    public function setEpisodeNumber(int $episodeNumber): Episode
    {
        $this->episodeNumber = $episodeNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getImdbNumber(): int
    {
        return $this->imdbNumber;
    }

    /**
     * @param int $imdbNumber
     * @return Episode
     */
    public function setImdbNumber(int $imdbNumber): Episode
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setEpisodeNumber(intval($rawData[1][$position]))
            ->setImdbNumber(intval($rawData[3][$position]))
            ->setTitle($rawData[5][$position])
            ->parseDate($rawData[2][$position]);
    }
}
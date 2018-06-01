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

    /** @var int */
    protected $episodeNumber;

    /** @var \DateTime */
    protected $date;

    /** @var int */
    protected $imdbNumber;

    /** @var string */
    protected $title;

    /** @var bool */
    protected $isFullDate;

    /**
     * @return bool
     */
    public function getIsFullDate(): bool
    {
        return $this->isFullDate;
    }

    /**
     * @param bool $isFullDate
     * @return Episode
     */
    public function setIsFullDate(bool $isFullDate): Episode
    {
        $this->isFullDate = $isFullDate;
        return $this;
    }

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
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     * @return Episode
     */
    public function setDate(?\DateTime $date): Episode
    {
        $this->date = $date;
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
            ->setTitle($rawData[6][$position])
            ->parseDate($rawData[2][$position]);
    }

    /**
     * @param string $rawData
     * @return Episode
     */
    protected function parseDate(string $rawData): Episode
    {
        // TODO: refactor this method in another model
        if (stripos($rawData, '.') !== false) {
            $monthFormat = "M.";
        } else {
            $monthFormat = "F";
        }
        $datetime = null;
        $this->setIsFullDate(false);
        $rawData = trim($rawData);
        if (substr_count($rawData, " ") === 2) {
            $datetime = \DateTime::createFromFormat("d {$monthFormat} Y", $rawData);
            $this->setIsFullDate(true);
        } elseif (substr_count($rawData, " ") === 1) {
            $datetime = \DateTime::createFromFormat("{$monthFormat} Y", $rawData);
        } else {
            $datetime = \DateTime::createFromFormat("Y", $rawData);
        }
        if (!$datetime) {
            $datetime = null;
            $this->setIsFullDate(false);
        }
        return $this->setDate($datetime);
    }
}
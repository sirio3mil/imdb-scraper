<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 16:24
 */

namespace ImdbScraper\Model;


class Release implements RegexMatchRawData
{
    /** @var string */
    protected $country;

    /** @var \DateTime */
    protected $date;

    /** @var array */
    protected $details;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Release
     */
    public function setCountry(string $country): Release
    {
        $this->country = $country;
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
     * @param \DateTime $date
     * @return Release
     */
    public function setDate(?\DateTime $date): Release
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param array $details
     * @return Release
     */
    public function setDetails(array $details): Release
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setCountry($rawData[2][$position])
            ->setDate(self::parseDate($rawData[3][$position]))
            ->setDetails(self::parseDetails($rawData[4][$position]));
    }

    protected static function parseDate(string $rawData): ?\DateTime
    {
        // TODO: dates month format is M if month name length greater than 3 otherwise F
        $datetime = null;
        $rawData = trim($rawData);
        if (substr_count($rawData, " ") === 2) {
            $datetime = \DateTime::createFromFormat("d F Y", $rawData);
        } elseif (substr_count($rawData, " ") === 1) {
            $datetime = \DateTime::createFromFormat("F Y", $rawData);
        }
        if (!$datetime) {
            $datetime = null;
        }
        return $datetime;
    }

    protected static function parseDetails(string $rawData): array
    {
        $rawData = trim($rawData);
        $details = [];
        if (stripos($rawData, ')') !== false) {
            $details = explode(')', $rawData);
            array_walk($details, function (&$item) {
                $item = trim(str_replace('(', '', $item));
            });
            $details = array_filter($details, function ($item) {
                return !empty($item);
            });
        } elseif (!empty($rawData)) {
            $details[] = $rawData;
        }
        return $details;
    }
}
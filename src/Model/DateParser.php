<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 07/06/2018
 * Time: 22:23
 */

namespace ImdbScraper\Model;


use ImdbScraper\Pages\Page;

trait DateParser
{

    /** @var bool */
    protected $isFullDate;

    /** @var \DateTime */
    protected $date;

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     * @return Page
     */
    public function setDate(?\DateTime $date): Page
    {
        $this->date = $date;
        return $this;
    }

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
     * @param string $rawData
     * @return Page
     */
    protected function parseDate(string $rawData): Page
    {
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
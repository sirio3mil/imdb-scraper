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

    /** @var string */
    protected $details;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): Release
    {
        $this->country = $country;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Release
     */
    public function setDate(\DateTime $date): Release
    {
        $this->date = $date;
        return $this;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function setDetails(string $details): Release
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
        $this->setCountry($rawData[2][$position])
            ->setDate(\DateTime::createFromFormat("d F Y", "{$rawData[3][$position]} {$rawData[5][$position]}"))
            ->setDetails($rawData[6][$position]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 28/05/2018
 * Time: 15:20
 */

namespace ImdbScraper\Model;


class People implements RegexMatchRawData
{

    /** @var string */
    protected $fullName;

    /** @var int */
    protected $imdbNumber;

    /**
     * @return string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return People
     */
    public function setFullName(string $fullName): People
    {
        $this->fullName = trim($fullName);
        return $this;
    }

    /**
     * @return int
     */
    public function getImdbNumber(): ?int
    {
        return $this->imdbNumber;
    }

    /**
     * @param int $imdbNumber
     * @return People
     */
    public function setImdbNumber(int $imdbNumber): People
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
        return $this->setFullName($rawData[2][$position])
            ->setImdbNumber(intval($rawData[1][$position]));
    }
}
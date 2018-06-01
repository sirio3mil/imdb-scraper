<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 12:15
 */

namespace ImdbScraper\Model;


class AlsoKnownAs implements RegexMatchRawData
{
    /** @var string */
    protected $country;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;
    
    /** @var string */
    protected $language;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return AlsoKnownAs
     */
    public function setCountry(string $country): AlsoKnownAs
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AlsoKnownAs
     */
    public function setDescription(string $description): AlsoKnownAs
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return AlsoKnownAs
     */
    public function setLanguage(string $language): AlsoKnownAs
    {
        $this->language = $language;
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
     * @return AlsoKnownAs
     */
    public function setTitle(string $title): AlsoKnownAs
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setTitle($rawData[3][$position])
            ->splitCountry($rawData[2][$position]);
    }

    /**
     * @param string $rawData
     * @return AlsoKnownAs
     */
    protected function splitCountry(string $rawData): AlsoKnownAs
    {
        
        return $this;
    }
}
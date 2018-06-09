<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/06/2018
 * Time: 23:37
 */

namespace ImdbScraper\Model;


use ImdbScraper\Helper\CountryName;

class Certificate implements RegexMatchRawData
{

    /** @var string */
    protected $isoCountryCode;

    /** @var string */
    protected $countryName;

    /** @var string */
    protected $certification;

    /** @var string */
    protected $details;

    /**
     * @return string
     */
    public function getCertification(): string
    {
        return $this->certification;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getIsoCountryCode(): string
    {
        return $this->isoCountryCode;
    }

    /**
     * @param string $certification
     * @return Certificate
     */
    public function setCertification(string $certification): Certificate
    {
        $this->certification = $certification;
        return $this;
    }

    /**
     * @param string $countryName
     * @return Certificate
     */
    public function setCountryName(string $countryName): Certificate
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * @param string $details
     * @return Certificate
     */
    public function setDetails(string $details): Certificate
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @param string $isoCountryCode
     * @return Certificate
     */
    public function setIsoCountryCode(string $isoCountryCode): Certificate
    {
        $this->isoCountryCode = $isoCountryCode;
        return $this;
    }

    /**
     * @param array $rawData
     * @param int $position
     * @return RegexMatchRawData
     */
    public function importData(array $rawData, int $position): RegexMatchRawData
    {
        return $this->setIsoCountryCode($rawData[1][$position])
            ->setCountryName(CountryName::getMappedValue($rawData[3][$position]))
            ->setCertification($rawData[4][$position])
            ->parseDetails($rawData[5][$position]);
    }

    /**
     * @param string $rawData
     * @return Certificate
     */
    protected function parseDetails(string $rawData): Certificate
    {
        $this->setDetails(trim(str_replace('(', '', str_replace(')', '', $rawData))));
        return $this;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:48
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Helper\CountryName;
use ImdbScraper\Parser\AbstractArrayParser;
use ImdbScraper\Parser\StringValidator;

class CountryParser extends AbstractArrayParser
{
    use StringValidator;

    /**
     * @return array
     */
    public function getArray(): array
    {
        /** @var array $values */
        $values = parent::getArray();
        array_walk($values, function(&$value){
            $value = CountryName::getMappedValue($value);
        });
        return array_unique($values);
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|country_of_origin=([^>]+)>([^>]+)<|U';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:48
 */

namespace ImdbScraper\Parser;


use ImdbScraper\Helper\CountryName;

class CountryParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|country_of_origin=([^>]+)>([^>]+)<|U';

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
}
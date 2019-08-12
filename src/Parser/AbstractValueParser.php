<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:55
 */

namespace ImdbScraper\Parser;


abstract class AbstractValueParser extends AbstractPositionParser
{

    /**
     * @return mixed
     */
    public function getValue()
    {
        $matches = $this->getMatches();
        $value = null;
        $index = $this->getPosition();
        if ($matches && array_key_exists($index, $matches) && !empty($matches[$index][0])) {
            $value = static::validateValue($matches[$index][0]);
        }
        return $value;
    }
}
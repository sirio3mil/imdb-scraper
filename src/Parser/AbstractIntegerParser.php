<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:57
 */

namespace ImdbScraper\Parser;


abstract class AbstractIntegerParser extends AbstractValueParser
{

    protected static function validateValue($value)
    {
        return intval(filter_var(trim($value), FILTER_SANITIZE_NUMBER_INT));
    }
}
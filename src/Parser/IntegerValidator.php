<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:18
 */

namespace ImdbScraper\Parser;


trait IntegerValidator
{
    public static function validateValue($value)
    {
        return intval(filter_var(trim($value), FILTER_SANITIZE_NUMBER_INT));
    }
}
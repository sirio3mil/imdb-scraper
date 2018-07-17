<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 15:31
 */

namespace ImdbScraper\Parser;


trait FloatValidator
{
    public static function validateValue($value)
    {
        return floatval(filter_var(trim(str_replace(',', '.', $value)), FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION));
    }
}
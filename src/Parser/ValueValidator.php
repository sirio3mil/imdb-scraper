<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:18
 */

namespace ImdbScraper\Parser;


interface ValueValidator
{
    public static function validateValue($value);
}
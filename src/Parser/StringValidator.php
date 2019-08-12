<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:21
 */

namespace ImdbScraper\Parser;

use function html_entity_decode;
use function trim;
use function strip_tags;

trait StringValidator
{
    public static function validateValue($value)
    {
        return html_entity_decode(trim(strip_tags($value)), ENT_QUOTES);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:35
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractArrayParser;
use ImdbScraper\Parser\StringValidator;

class LanguageParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|primary_language=([^>]+)>([^>]+)<|U';
}
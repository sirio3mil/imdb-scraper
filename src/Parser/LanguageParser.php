<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:35
 */

namespace ImdbScraper\Parser;


class LanguageParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|primary_language=([^>]+)>([^>]+)<|U';
}
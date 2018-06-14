<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:39
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\StringValidator;

class GenreParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|/genre/([^>]+)\?ref_=tt_stry_gnr">([^>]+)<|U';
}
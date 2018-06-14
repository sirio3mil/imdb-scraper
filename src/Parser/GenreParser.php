<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:39
 */

namespace ImdbScraper\Parser;


class GenreParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|/genre/([^>]+)\?ref_=tt_stry_gnr">([^>]+)<|U';
}
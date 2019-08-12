<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:39
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractArrayParser;
use ImdbScraper\Parser\StringValidator;

class GenreParser extends AbstractArrayParser
{
    use StringValidator;

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|/search/title\?genres=([^>]+)&explore=title_type,genres&ref_=tt_ov_inf">([^>]+)<|U';
    }
}
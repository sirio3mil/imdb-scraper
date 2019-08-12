<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:35
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractStringParser;

class ColorParser extends AbstractStringParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href=\"/search/title\?colors=([^>]+)\">([^>]+)</a>|U';
    }
}
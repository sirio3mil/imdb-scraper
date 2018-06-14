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
    /** @var string */
    protected const PATTERN = '|<a href=\"/search/title\?colors=([^>]+)\"itemprop=\'url\'>([^>]+)</a>|U';
}
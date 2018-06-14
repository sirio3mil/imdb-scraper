<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:48
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractStringParser;

class TitleParser extends AbstractStringParser
{
    /** @var string */
    protected const PATTERN = '|<title>([^>]+) \(|U';
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:06
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractCounterParser;

class TotalSeasonsParser extends AbstractCounterParser
{
    /** @var string */
    protected const PATTERN = '|episodes\?season=([0-9]{1,2})|U';
}
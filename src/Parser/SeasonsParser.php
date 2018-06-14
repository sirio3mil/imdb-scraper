<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:06
 */

namespace ImdbScraper\Parser;


class SeasonsParser extends AbstractCounterParser
{
    /** @var string */
    protected const PATTERN = '|episodes\?season=([0-9]{1,2})|U';
}
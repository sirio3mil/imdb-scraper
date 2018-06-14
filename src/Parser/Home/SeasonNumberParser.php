<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:46
 */

namespace ImdbScraper\Parser\Home;


class SeasonNumberParser extends AbstractIntegerParser
{
    /** @var string */
    protected const PATTERN = '|>Season ([0-9]{1,2}) <|U';
}
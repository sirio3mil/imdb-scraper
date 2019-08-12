<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:46
 */

namespace ImdbScraper\Parser\Home;

use ImdbScraper\Parser\AbstractIntegerParser;

class SeasonNumberParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|>Season ([0-9]{1,2}) <|U';
    }
}

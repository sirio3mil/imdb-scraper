<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:59
 */

namespace ImdbScraper\Parser\Home;

use ImdbScraper\Parser\AbstractIntegerParser;

class YearParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<title>([^>]+)([1-2][0-9][0-9][0-9])([^>]+)</title>|U';
    }
}

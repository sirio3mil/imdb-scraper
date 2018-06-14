<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:59
 */

namespace ImdbScraper\Parser;


class YearParser extends AbstractIntegerParser
{
    /** @var string */
    protected const PATTERN = '|<title>([^>]+)([1-2][0-9][0-9][0-9])([^>]+)</title>|U';
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:15
 */

namespace ImdbScraper\Parser;


class TvShowParser extends AbstractIntegerParser
{
    /** @var string */
    protected const PATTERN = '|<div class=\"titleParent\"><a href=\"/title/tt([0-9]{7})|U';
}
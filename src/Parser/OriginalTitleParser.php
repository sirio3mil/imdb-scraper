<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:51
 */

namespace ImdbScraper\Parser;


class OriginalTitleParser extends AbstractStringParser
{
    /** @var string */
    protected const PATTERN = '|<div class=\"originalTitle\">([^>]+)<span|U';
}
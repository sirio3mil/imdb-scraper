<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:03
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractIntegerParser;

class ScoreParser extends AbstractIntegerParser
{
    /** @var string */
    protected const PATTERN = '|<span itemprop="ratingValue">([^>]+)</span>|U';
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:03
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractFloatParser;

class ScoreParser extends AbstractFloatParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<span itemprop="ratingValue">([^>]+)</span>|U';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:31
 */

namespace ImdbScraper\Parser\Home;

use ImdbScraper\Parser\AbstractIntegerParser;

class VoteParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<span class="small" itemprop="ratingCount">([^>]+)</span>|U';
    }
}

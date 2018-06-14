<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:31
 */

namespace ImdbScraper\Parser\Home;


class VoteParser extends AbstractIntegerParser
{
    /** @var string */
    protected const PATTERN = '|<span class="small" itemprop="ratingCount">([^>]+)</span>|U';
}
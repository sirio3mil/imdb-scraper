<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:15
 */

namespace ImdbScraper\Parser\Keyword;

use ImdbScraper\Parser\AbstractIntegerParser;

class TotalKeywordsParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<div class="desc">Showing all ([0-9]+) plot keywords</div>|U';
    }
}

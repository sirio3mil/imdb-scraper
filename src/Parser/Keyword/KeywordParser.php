<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:16
 */

namespace ImdbScraper\Parser\Keyword;

use ImdbScraper\Iterator\KeywordIterator;
use ImdbScraper\Mapper\KeywordMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class KeywordParser extends AbstractIteratorParser
{

    public function __construct(KeywordMapper $pageMapper)
    {
        parent::__construct($pageMapper, new KeywordIterator());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href="/search/keyword\?keywords=([^>]+)">([^>]+)</a></div>' .
            '<div class="did-you-know-actions"><div class="interesting-count-text">' .
            '<a href="\?item=kw([0-9]{7})">([^>]+)</a>|U';
    }
}

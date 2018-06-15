<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:16
 */

namespace ImdbScraper\Parser\Keyword;


use ImdbScraper\Mapper\KeywordMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class KeywordParser extends AbstractIteratorParser
{

    /** @var string */
    protected const PATTERN = '|<a href="/keyword/([^>]+)\?ref_=ttkw_kw_([0-9]+)">([^>]+)</a></div><div class="did-you-know-actions"><div class="interesting-count-text"><a href="\?item=kw([0-9]{7})">([^>]+)</a>|U';

    public function __construct(KeywordMapper $pageMapper)
    {
        parent::__construct($pageMapper, 'ImdbScraper\Iterator\KeywordIterator');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:02
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\KeywordIterator;

class KeywordMapper extends AbstractPageMapper
{

    /** @var string */
    protected const KEYWORD_PATTERN = '|<a href="/keyword/([^>]+)\?ref_=ttkw_kw_([0-9]+)">([^>]+)</a></div><div class="did-you-know-actions"><div class="interesting-count-text"><a href="\?item=kw([0-9]{7})">([^>]+)</a>|U';

    /** @var string */
    protected const TOTAL_KEYWORD_PATTERN = '|<div class="desc">Showing all ([0-9]+) plot keywords</div>|U';

    public function __construct()
    {
        $this->setFolder('keywords');
    }

    /**
     * @return int
     */
    public function getTotalKeywords(): int
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::TOTAL_KEYWORD_PATTERN, $this->content, $matches);
        }
        return (!empty($matches[1]) && !empty($matches[1][0])) ? intval($matches[1][0]) : 0;
    }

    /**
     * @return KeywordIterator
     */
    public function getKeywords(): KeywordIterator
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::KEYWORD_PATTERN, $this->content, $matches);
        }
        return (new KeywordIterator())->appendAll($matches);
    }
}
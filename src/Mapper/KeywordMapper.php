<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:02
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\KeywordIterator;
use ImdbScraper\Parser\Keyword\KeywordParser;
use ImdbScraper\Parser\Keyword\TotalKeywordsParser;

class KeywordMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder('keywords');
    }

    /**
     * @return int
     */
    public function getTotalKeywords(): int
    {
        $totalKeywords = (new TotalKeywordsParser($this))->setPosition(1)->getValue();
        return $totalKeywords ?? 0;
    }

    /**
     * @return KeywordIterator
     */
    public function getKeywords(): KeywordIterator
    {
        return (new KeywordParser($this))->getRegexIterator();
    }
}
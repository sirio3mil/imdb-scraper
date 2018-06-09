<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:45
 */

namespace Tests\Feature;

use ImdbScraper\Iterator\KeywordIterator;
use ImdbScraper\Model\Keyword;
use ImdbScraper\Mapper\KeywordMapper;
use PHPUnit\Framework\TestCase;

class KeywordsTest extends TestCase
{

    /** @var KeywordMapper $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new KeywordMapper())->setImdbNumber(5463162)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetTotalKeywords()
    {
        $this->assertGreaterThanOrEqual(413, $this->imdbScrapper->getTotalKeywords());
    }

    public function testGetKeywords()
    {
        /** @var KeywordIterator $keywords */
        $keywords = $this->imdbScrapper->getKeywords();
        /** @var Keyword $keyword */
        $keyword = $keywords->getIterator()->current();
        $this->assertEquals($this->imdbScrapper->getTotalKeywords(), $keywords->getIterator()->count());
        $this->assertEquals('breaking-the-fourth-wall', $keyword->getUrl());
        $this->assertEquals('breaking the fourth wall', $keyword->getKeyword());
        $this->assertEquals(12410, $keyword->getImdbNumber());
        $this->assertGreaterThanOrEqual(3, $keyword->getRelevantVotes());
        $this->assertGreaterThanOrEqual(3, $keyword->getTotalVotes());
    }
}

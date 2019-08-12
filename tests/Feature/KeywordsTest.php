<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:45
 */

namespace Tests\Feature;

use ArrayIterator;
use Exception;
use ImdbScraper\Iterator\KeywordIterator;
use ImdbScraper\Model\Keyword;
use ImdbScraper\Mapper\KeywordMapper;
use PHPUnit\Framework\TestCase;

class KeywordsTest extends TestCase
{

    /** @var KeywordMapper $imdbScrapper */
    protected $imdbScrapper;

    /**
     * KeywordsTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     * @throws Exception
     */
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
        /** @var ArrayIterator $iterator */
        $iterator = $keywords->getIterator();
        $total = $iterator->count();
        $this->assertEquals($this->imdbScrapper->getTotalKeywords(), $total);
        $this->assertGreaterThan(0, $total);
        $matches = 0;
        /** @var Keyword $keyword */
        foreach ($keywords as $keyword) {
            $url = $keyword->getUrl();
            if ($url == 'breaking-the-fourth-wall') {
                $this->assertEquals('breaking the fourth wall', $keyword->getKeyword());
                $this->assertEquals(12410, $keyword->getImdbNumber());
                $this->assertGreaterThanOrEqual(3, $keyword->getRelevantVotes());
                $this->assertGreaterThanOrEqual(3, $keyword->getTotalVotes());
                $matches++;
            }
        }
        $this->assertEquals(1, $matches);
    }
}

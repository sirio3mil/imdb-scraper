<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:44
 */

namespace Tests\Feature;

use Exception;
use ImdbScraper\Model\CastPeople;
use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Model\People;
use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Mapper\CastMapper;
use PHPUnit\Framework\TestCase;

class CreditsTest extends TestCase
{

    /** @var CastMapper $imdbScrapper */
    protected $imdbScrapper;

    /**
     * CreditsTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     * @throws Exception
     * @link https://www.imdb.com/title/tt5164214/
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new CastMapper())->setImdbNumber(5164214)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCast()
    {
        $found = 0;
        $cast = $this->imdbScrapper->getCast();
        /** @var CastPeople $actor */
        foreach ($cast as $actor) {
            switch ($actor->getImdbNumber()) {
                case 113:
                    ++$found;
                    $this->assertEquals('Sandra Bullock', $actor->getFullName());
                    $this->assertEquals('Debbie Ocean', $actor->getCharacter());
                    break;
                case 939026:
                    ++$found;
                    $this->assertEquals('Daniel May Wong', $actor->getFullName());
                    $this->assertEquals('Costume Exhibit Security Guard', $actor->getCharacter());
                    $this->assertEquals('Daniel M. Wong', $actor->getAlias());
                    break;
            }
        }
        $this->assertEquals(2, $found);
    }

    public function testGetWriters()
    {
        /** @var PersonIterator $writers */
        $writers = $this->imdbScrapper->getWriters();
        $ids = [];
        /** @var People $writer */
        foreach ($writers as $writer) {
            $ids[] = $writer->getImdbNumber();
        }
        $this->assertContains(425138, $ids);
    }

    public function testGetDirectors()
    {
        /** @var People $director */
        $director = (new People())->setFullName('Gary Ross')->setImdbNumber(2657);
        $this->assertEquals($director, $this->imdbScrapper->getDirectors()->getIterator()->current());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:44
 */

namespace Tests\Feature;

use ImdbScraper\Model\CastPeople;
use ImdbScraper\Model\CastPeopleList;
use ImdbScraper\Model\People;
use ImdbScraper\Model\PeopleList;
use ImdbScraper\Pages\Credits;
use PHPUnit\Framework\TestCase;

class CreditsTest extends TestCase
{

    /** @var Credits $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new Credits())->setImdbNumber(5164214)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCast()
    {
        $found = false;
        /** @var CastPeopleList $cast */
        $cast = $this->imdbScrapper->getCast();
        /** @var CastPeople $actor */
        foreach ($cast as $actor) {
            if ($actor->getImdbNumber() === 8569954) {
                $found = true;
                $this->assertEquals('Nina Cuso', $actor->getFullName());
                $this->assertEquals('Vogue Editor', $actor->getCharacter());
                $this->assertEquals('Christina Mancuso', $actor->getAlias());
            }
        }
        $this->assertEquals(true, $found);
    }

    public function testGetWriters()
    {
        /** @var PeopleList $writers */
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
        $this->assertEquals(new PeopleList([$director]), $this->imdbScrapper->getDirectors());
    }
}

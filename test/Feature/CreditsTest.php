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
        $found = 0;
        /** @var CastPeopleList $cast */
        $cast = $this->imdbScrapper->getCast();
        /** @var CastPeople $actor */
        foreach ($cast as $actor) {
            switch ($actor->getImdbNumber()) {
                case 8551937:
                    ++$found;
                    $this->assertEquals('Courtney Gonzalez', $actor->getFullName());
                    $this->assertEquals('Bergdorf Patron (sin acreditar)', $actor->getCharacter());
                    break;
                case 8569954:
                    ++$found;
                    $this->assertEquals('Nina Cuso', $actor->getFullName());
                    $this->assertEquals('Vogue Editor', $actor->getCharacter());
                    $this->assertEquals('Christina Mancuso', $actor->getAlias());
                    break;
            }
        }
        $this->assertEquals(2, $found);
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

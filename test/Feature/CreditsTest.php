<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:44
 */

namespace Tests\Feature;

use ImdbScraper\Model\People;
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
    }

    public function testGetWriters()
    {
        $writers = $this->imdbScrapper->getWriters();
        $ids = [];
        /** @var People $writer */
        foreach ($writers as $writer){
            $ids[] = $writer->getImdbNumber();
        }
        $this->assertContains(425138, $ids);
    }

    public function testGetDirectors()
    {
        $director = (new People())->setFullName('Gary Ross')->setImdbNumber(2657);
        $this->assertEquals([$director], $this->imdbScrapper->getDirectors());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/05/2018
 * Time: 23:29
 */

namespace Tests\Feature;

use ImdbScraper\Pages\Home;
use PHPUnit\Framework\TestCase;

class TvShowHomeTest extends TestCase
{

    /** @var Home $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new Home())->setImdbNumber(944947)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetTitle()
    {
        $this->assertEquals('Game of Thrones', $this->imdbScrapper->getTitle());
    }

    public function testIsTvShow()
    {
        $this->assertEquals(true, $this->imdbScrapper->isTvShow());
    }

    public function testGetSeasons()
    {
        $this->assertEquals(8, $this->imdbScrapper->getSeasons());
    }
}

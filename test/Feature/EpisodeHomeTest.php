<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/05/2018
 * Time: 23:28
 */

namespace Tests\Feature;

use ImdbScraper\Mapper\HomeMapper;
use PHPUnit\Framework\TestCase;

class EpisodeHomeTest extends TestCase
{

    /** @var HomeMapper $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new HomeMapper())->setImdbNumber(5655178)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetTitle()
    {
        $this->assertEquals('Stormborn', $this->imdbScrapper->getTitle());
    }

    public function testGetEpisodeNumber()
    {
        $this->assertEquals(2, $this->imdbScrapper->getEpisodeNumber());
    }

    public function testIsEpisode()
    {
        $this->assertEquals(true, $this->imdbScrapper->isEpisode());
    }

    public function testGetSeasonNumber()
    {
        $this->assertEquals(7, $this->imdbScrapper->getSeasonNumber());
    }

    public function testGetTvShow()
    {
        $this->assertEquals(944947, $this->imdbScrapper->getTvShow());
    }
}

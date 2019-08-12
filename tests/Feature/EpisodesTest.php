<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:44
 */

namespace Tests\Feature;

use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Model\Episode;
use ImdbScraper\Mapper\EpisodeListMapper;
use PHPUnit\Framework\TestCase;

class EpisodesTest extends TestCase
{

    /** @var EpisodeListMapper $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new EpisodeListMapper())->setImdbNumber(944947)->setSeason(7)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetEpisodes()
    {
        /** @var EpisodeIterator $episodes */
        $episodes = $this->imdbScrapper->getEpisodes();
        /** @var Episode $episode */
        $episode = $episodes->getIterator()->current();
        $this->assertInstanceOf(Episode::class, $episode);
        $this->assertEquals('Dragonstone', $episode->getTitle());
        $this->assertEquals(1, $episode->getEpisodeNumber());
        $this->assertEquals(5654088, $episode->getImdbNumber());
        $this->assertEquals(true, $episode->getIsFullDate());
        $this->assertEquals('20170716', $episode->getDate()->format('Ymd'));
    }
}

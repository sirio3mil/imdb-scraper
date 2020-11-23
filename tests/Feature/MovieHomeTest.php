<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 04/05/2018
 * Time: 23:17
 */

namespace Tests\Feature;

use Exception;
use ImdbScraper\Mapper\HomeMapper;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class MovieHomeTest extends TestCase
{

    /** @var HomeMapper $imdbScrapper */
    protected $imdbScrapper;

    /**
     * MovieHomeTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     * @throws Exception
     * @link https://www.imdb.com/title/tt1563742/
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new HomeMapper())->setImdbNumber(1563742)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetYear()
    {
        $this->assertEquals(2018, $this->imdbScrapper->getYear());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetTvShow()
    {
        $this->assertEquals(null, $this->imdbScrapper->getTvShow());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testHaveReleaseInfo()
    {
        $this->assertEquals(true, $this->imdbScrapper->haveReleaseInfo());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetLanguages()
    {
        $this->assertEquals(['English', 'Norwegian', 'Spanish', 'French'], $this->imdbScrapper->getLanguages());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testIsTvShow()
    {
        $this->assertEquals(false, $this->imdbScrapper->isTvShow());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetTitle()
    {
        $this->assertEquals('Overboard', $this->imdbScrapper->getTitle());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetDuration()
    {
        $this->assertEquals(112, $this->imdbScrapper->getDuration());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetColor()
    {
        $this->assertEquals('Color', $this->imdbScrapper->getColor());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetRecommendations()
    {
        $this->assertNotEmpty($this->imdbScrapper->getRecommendations());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetCountries()
    {
        $this->assertEquals(['United States', 'Mexico'], $this->imdbScrapper->getCountries());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testIsEpisode()
    {
        $this->assertFalse($this->imdbScrapper->isEpisode());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetGenres()
    {
        $this->assertEquals(['Comedy', 'Romance'], $this->imdbScrapper->getGenres());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetSounds()
    {
        $this->assertEquals(['Dolby Digital'], $this->imdbScrapper->getSounds());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetScore()
    {
        $this->assertGreaterThan(5, $this->imdbScrapper->getScore());
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testGetVotes()
    {
        $this->assertGreaterThan(30000, $this->imdbScrapper->getVotes());
    }
}

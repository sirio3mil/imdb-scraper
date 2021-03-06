<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 03/05/2018
 * Time: 17:27
 */

namespace Tests\Feature;

use ImdbScraper\Controller\MainController;
use PHPUnit\Framework\TestCase;

class MovieMainTest extends TestCase
{

    /** @var MainController $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = new MainController(1563742);
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCredits()
    {
        $this->assertNotEmpty($this->imdbScrapper->getCredits()->getContent());
    }

    public function testGetKeywords()
    {
        $this->assertNotEmpty($this->imdbScrapper->getKeywords()->getContent());
    }

    public function testGetLocations()
    {
        $this->assertNotEmpty($this->imdbScrapper->getLocations()->getContent());
    }

    public function testGetHome()
    {
        $this->assertNotEmpty($this->imdbScrapper->getHome()->getContent());
    }

    public function testGetReleaseInfo()
    {
        $this->assertNotEmpty($this->imdbScrapper->getReleaseInfo()->getContent());
    }

    public function testGetParentalGuide()
    {
        $this->assertNotEmpty($this->imdbScrapper->getParentalGuide()->getContent());
    }
}

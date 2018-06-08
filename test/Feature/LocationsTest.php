<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:45
 */

namespace Tests\Feature;

use ImdbScraper\Lists\LocationList;
use ImdbScraper\Model\Location;
use ImdbScraper\Pages\Locations;
use PHPUnit\Framework\TestCase;

class LocationsTest extends TestCase
{

    /** @var Locations $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new Locations())->setImdbNumber(3778644)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetLocations()
    {
        /** @var LocationList $locations */
        $locations = $this->imdbScrapper->getLocations();
        /** @var Location $location */
        $location = $locations->getIterator()->current();
        $this->assertEquals('Tre Cime, Italy', $location->getLocation());
        $this->assertGreaterThanOrEqual(16, $location->getRelevantVotes());
        $this->assertGreaterThanOrEqual(16, $location->getTotalVotes());
    }
}

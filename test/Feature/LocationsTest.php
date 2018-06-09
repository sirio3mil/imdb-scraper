<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:45
 */

namespace Tests\Feature;

use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Model\Location;
use ImdbScraper\Mapper\LocationMapper;
use PHPUnit\Framework\TestCase;

class LocationsTest extends TestCase
{

    /** @var LocationMapper $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new LocationMapper())->setImdbNumber(3778644)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetLocations()
    {
        /** @var LocationIterator $locations */
        $locations = $this->imdbScrapper->getLocations();
        /** @var Location $location */
        $location = $locations->getIterator()->current();
        $this->assertEquals('Tre Cime, Italy', $location->getLocation());
        $this->assertGreaterThanOrEqual(16, $location->getRelevantVotes());
        $this->assertGreaterThanOrEqual(16, $location->getTotalVotes());
    }
}

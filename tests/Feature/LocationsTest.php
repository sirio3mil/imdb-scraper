<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:45
 */

namespace Tests\Feature;

use Exception;
use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Model\Location;
use ImdbScraper\Mapper\LocationMapper;
use PHPUnit\Framework\TestCase;

class LocationsTest extends TestCase
{

    /** @var LocationMapper $imdbScrapper */
    protected $imdbScrapper;

    /**
     * LocationsTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     * @throws Exception
     * @link https://www.imdb.com/title/tt3778644/
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new LocationMapper())->setImdbNumber(3778644)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetLocations()
    {
        $locations = $this->imdbScrapper->getLocations();
        $iterator = $locations->getIterator();
        $found = 0;
        while ($iterator->valid()) {
            /** @var Location $location */
            $location = $iterator->current();
            if ($location->getLocation() === 'Tre Cime, Italy') {
                ++$found;
                $this->assertGreaterThanOrEqual(34, $location->getRelevantVotes());
                $this->assertGreaterThanOrEqual(34, $location->getTotalVotes());
            }
            $iterator->next();
        }
        $this->assertEquals(1, $found);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 16:52
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Parser\Location\LocationParser;

class LocationMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder('locations');
    }

    /**
     * @return LocationIterator
     */
    public function getLocations(): LocationIterator
    {
        return (new LocationParser($this))->getIterator();
    }
}
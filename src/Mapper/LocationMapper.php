<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 16:52
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\LocationIterator;

class LocationMapper extends AbstractPageMapper
{

    /** @var string */
    protected const LOCATIONS_PATTERN = '|<dt><a ([^>]+)>([^>]+)</a></dt><dd>([^>]+)</dd><div class="did-you-know-actions"><a ([^>]+)>([^>]+)</a>|U';

    public function __construct()
    {
        $this->setFolder('locations');
    }

    /**
     * @return LocationIterator
     */
    public function getLocations(): LocationIterator
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::LOCATIONS_PATTERN, $this->content, $matches);
        }
        return (new LocationIterator())->appendAll($matches);
    }
}
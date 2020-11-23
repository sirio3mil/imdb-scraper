<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 13:00
 */

namespace ImdbScraper\Iterator;

use ImdbScraper\Model\Location;

class LocationIterator extends AbstractRegexIterator
{

    public function __construct(Location $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new Location();
        }
        parent::__construct($regexModel);
    }
}
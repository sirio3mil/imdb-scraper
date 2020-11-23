<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:22
 */

namespace ImdbScraper\Parser\Location;

use ImdbScraper\Iterator\LocationIterator;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class LocationParser extends AbstractIteratorParser
{

    public function __construct(LocationMapper $pageMapper)
    {
        parent::__construct($pageMapper, new LocationIterator());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<dt><a ([^>]+)>([^>]+)</a></dt><dd>([^>]*)</dd>' .
            '<div class="did-you-know-actions"><a ([^>]+)>([^>]+)</a>|U';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 15/06/2018
 * Time: 23:22
 */

namespace ImdbScraper\Parser\Release;

use ImdbScraper\Iterator\ReleaseIterator;
use ImdbScraper\Mapper\ReleaseMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class ReleaseParser extends AbstractIteratorParser
{

    public function __construct(ReleaseMapper $pageMapper)
    {
        parent::__construct($pageMapper, new ReleaseIterator());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<td class="release-date-item__country-name"><a href="([^>]+)">([^>]+)</a></td>' .
            '<td class="release-date-item__date" align="right">([^>]+)</td><td([^>]+)>([^>]*)</td>|U';
    }
}

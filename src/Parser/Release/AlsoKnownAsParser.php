<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 15/06/2018
 * Time: 23:24
 */

namespace ImdbScraper\Parser\Release;

use ImdbScraper\Iterator\AlsoKnownAsIterator;
use ImdbScraper\Mapper\ReleaseMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class AlsoKnownAsParser extends AbstractIteratorParser
{

    public function __construct(ReleaseMapper $pageMapper)
    {
        parent::__construct($pageMapper, new AlsoKnownAsIterator());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<tr class="([^>]+)"><td class="aka-item__name">([^>]+)</td>' .
            '<td class="aka-item__title">([^>]+)</td></tr>|U';
    }
}

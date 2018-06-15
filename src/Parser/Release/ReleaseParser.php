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

    /** @var string */
    protected const PATTERN = '|<td><a href=\"([^>]+)\">([^>]+)</a></td><td class=\"release_date\">([^>]+)</td><td>([^>]*)</td>|U';

    public function __construct(ReleaseMapper $pageMapper)
    {
        parent::__construct($pageMapper, new ReleaseIterator());
    }
}
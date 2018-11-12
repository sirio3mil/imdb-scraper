<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:25
 */

namespace ImdbScraper\Parser\Cast;


use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class CastParser extends AbstractIteratorParser
{

    /** @var string */
    protected const PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\">([^>]+)</a></td><td class=\"ellipsis\">(.*)</td><td class=\"character\">(.*)</td>|U';

    public function __construct(CastMapper $pageMapper)
    {
        parent::__construct($pageMapper, new CastIterator());
    }
}
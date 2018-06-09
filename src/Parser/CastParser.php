<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:25
 */

namespace ImdbScraper\Parser;


use ImdbScraper\Mapper\CastMapper;

class CastParser extends AbstractParser
{

    /** @var string */
    protected const PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"itemprop=\'url\'><span class=\"itemprop\" itemprop=\"name\">([^>]+)</span></a></td><td class=\"ellipsis\">(.*)</td><td class=\"character\">(.*)</td>|U';

    public function __construct(CastMapper $pageMapper)
    {
        parent::__construct($pageMapper,'ImdbScraper\Iterator\CastIterator');
    }
}
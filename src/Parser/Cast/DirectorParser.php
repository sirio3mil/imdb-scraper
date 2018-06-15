<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:21
 */

namespace ImdbScraper\Parser\Cast;


use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class DirectorParser extends AbstractIteratorParser
{

    /** @var string */
    protected const PATTERN = '|<a href="/name/nm([^>]+)/\?ref_=ttfc_fc_dr([0-9]+)">([^>]+)</a>|U';

    public function __construct(CastMapper $pageMapper)
    {
        parent::__construct($pageMapper, new PersonIterator());
    }
}
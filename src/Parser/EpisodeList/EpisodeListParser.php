<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:38
 */

namespace ImdbScraper\Parser\EpisodeList;


use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class EpisodeListParser extends AbstractIteratorParser
{

    /** @var string */
    protected const PATTERN = '|<meta itemprop="episodeNumber" content="([0-9]{1,2})"/><div class="airdate">([^>]+)</div><strong><a href="/title/tt([0-9]{7})/\?ref_=ttep_ep([0-9]{1,2})"title="([^>]+)" itemprop="name">([^>]+)</a></strong>|U';

    public function __construct(EpisodeListMapper $pageMapper)
    {
        parent::__construct($pageMapper, new EpisodeIterator());
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:38
 */

namespace ImdbScraper\Parser;


use ImdbScraper\Mapper\EpisodeListMapper;

class EpisodeListParser extends AbstractParser
{

    /** @var string */
    protected const PATTERN = '|<meta itemprop="episodeNumber" content="([0-9]{1,2})"/><div class="airdate">([^>]+)</div><strong><a href="/title/tt([0-9]{7})/\?ref_=ttep_ep([0-9]{1,2})"title="([^>]+)" itemprop="name">([^>]+)</a></strong>|U';

    public function __construct(EpisodeListMapper $pageMapper)
    {
        parent::__construct($pageMapper, 'ImdbScraper\Iterator\EpisodeIterator');
    }
}
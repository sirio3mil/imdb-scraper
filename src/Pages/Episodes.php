<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:40
 */

namespace ImdbScraper\Pages;


use ImdbScraper\Lists\EpisodeList;

class Episodes extends Page
{

    /** @var string */
    protected const EPISODE_LIST_PATTERN = '|<meta itemprop="episodeNumber" content="([0-9]{1,2})"><div class="airdate">([^>]+)</div><strong><a href="/title/tt([0-9]{7})/\?ref_=ttep_ep([0-9]{1,2})" title="([^>]+)" itemprop="name">([^>]+)</a></strong>|U';

    /** @var int */
    protected $season;

    /**
     * Episodes constructor.
     * @param int $season
     */
    public function __construct(int $season)
    {
        $this->setSeason($season)->setFolder('episodes?season=' + $this->getSeason());
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @param int $season
     * @return Episodes
     */
    public function setSeason(int $season): Episodes
    {
        $this->season = $season;
        return $this;
    }

    /**
     * @return EpisodeList
     */
    public function getEpisodes(): EpisodeList
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::EPISODE_LIST_PATTERN, $this->content, $matches);
        }
        return (new EpisodeList())->appendAll($matches);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:40
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Parser\EpisodeList\EpisodeListParser;

class EpisodeListMapper extends AbstractPageMapper
{

    /** @var int */
    protected $season;

    /**
     * @param string $folder
     * @return AbstractPageMapper
     */
    public function setFolder(string $folder): AbstractPageMapper
    {
        return parent::setFolder('episodes?season=' . $folder);
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
     * @return AbstractPageMapper
     */
    public function setSeason(int $season): AbstractPageMapper
    {
        $this->season = $season;
        return $this->setFolder(strval($this->season));
    }

    /**
     * @return EpisodeIterator
     */
    public function getEpisodes(): EpisodeIterator
    {
        /** @var EpisodeIterator $iterator */
        $iterator = (new EpisodeListParser($this))->getRegexIterator();
        return $iterator;
    }
}
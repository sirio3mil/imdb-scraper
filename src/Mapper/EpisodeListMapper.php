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
use function sprintf;
use function stripos;

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
        $str = sprintf('<h3 id="episode_top" itemprop="name">Season %u</h3>', $this->season);
        if (stripos($this->getContent(), $str) === false) {
            $this->setContent('');
        }
        /** @var EpisodeIterator $iterator */
        $iterator = (new EpisodeListParser($this))->getRegexIterator();
        return $iterator;
    }
}

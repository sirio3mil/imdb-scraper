<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:22
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Parser\ColorParser;
use ImdbScraper\Parser\CountryParser;
use ImdbScraper\Parser\DurationParser;
use ImdbScraper\Parser\EpisodeNumberParser;
use ImdbScraper\Parser\GenreParser;
use ImdbScraper\Parser\LanguageParser;
use ImdbScraper\Parser\OriginalTitleParser;
use ImdbScraper\Parser\RecommendationParser;
use ImdbScraper\Parser\SeasonNumberParser;
use ImdbScraper\Parser\SoundParser;
use ImdbScraper\Parser\TotalSeasonsParser;
use ImdbScraper\Parser\TitleParser;
use ImdbScraper\Parser\TvShowParser;
use ImdbScraper\Parser\VotesParser;
use ImdbScraper\Parser\YearParser;

class HomeMapper extends AbstractPageMapper
{

    protected const SEASON_SPLITTER = '<h4 class="float-left">Seasons</h4>';

    /** @var int */
    protected $season;

    /** @var int */
    protected $episode;

    /** @var string */
    protected $title;

    /** @var bool */
    protected $episodeFlag;

    /** @var bool */
    protected $tvShow;

    /**
     * @return int
     */
    public function getSeasons(): int
    {
        return (new TotalSeasonsParser($this))->getTotal();
    }

    /**
     * @return bool
     */
    public function isTvShow(): bool
    {
        if ($this->tvShow === null) {
            $this->setTvShowFlags();
        }
        return $this->tvShow;
    }

    /**
     * @return int|null
     */
    public function getTvShow(): ?int
    {
        if ($this->isEpisode()) {
            return (new TvShowParser($this))->setPosition(1)->getValue();
        }
        return null;
    }

    /**
     * @return HomeMapper
     */
    public function setTvShowFlags(): HomeMapper
    {
        $this->episodeFlag = false;
        $matches = [
            'Episode cast overview',
            'Episode credited cast',
            'Episode complete credited cast'
        ];
        foreach ($matches as $match) {
            if (strpos($this->content, $match) !== false) {
                $this->episodeFlag = true;
                $this->tvShow = false;
                return $this;
            }
        }
        $this->tvShow = (strpos($this->content, static::SEASON_SPLITTER) !== false) ? true : false;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEpisode(): bool
    {
        if ($this->episodeFlag === null) {
            $this->setTvShowFlags();
        }
        return $this->episodeFlag;
    }

    /**
     * @return bool
     */
    public function haveReleaseInfo(): bool
    {
        if (strpos($this->content, "Also Known As:") === false) {
            return false;
        }
        if (strpos($this->content, "Release Date:") === false) {
            return false;
        }
        return true;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        if (is_null($this->title)) {
            $this->setTitle();
        }
        return $this->title;
    }

    /**
     * @return HomeMapper
     */
    public function setTitle(): HomeMapper
    {
        $title = (new TitleParser($this))->setPosition(1)->getValue();
        if ($this->isEpisode()) {
            $parts = explode("\"", $title);
            $title = end($parts);
        } else {
            if (strpos($this->content, "(original title)") !== false) {
                $title = (new OriginalTitleParser($this))->setPosition(1)->getValue();
            } else {
                $parts = explode("(", $title);
                $title = trim($parts[0]);
            }
        }
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return (new YearParser($this))->setPosition(2)->getValue();
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return (new DurationParser($this))->setPosition(1)->getValue();
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        $score = (new ScoreParser($this))->setPosition(1)->getValue();
        return $score ?? 0;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        $votes = (new VotesParser($this))->setPosition(1)->getValue();
        return $votes ?? 0;
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        return (new ColorParser($this))->setPosition(2)->getValue();
    }

    /**
     * @return array
     */
    public function getSounds(): array
    {
        return (new SoundParser($this))->setPosition(2)->getArray();
    }

    /**
     * @return array
     */
    public function getRecommendations(): array
    {
        return (new RecommendationParser($this))->setPosition(1)->getArray();
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return (new CountryParser($this))->setPosition(2)->getArray();
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return (new LanguageParser($this))->setPosition(2)->getArray();
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return (new GenreParser($this))->setPosition(2)->getArray();
    }

    /**
     * @return HomeMapper
     */
    public function setSeasonData(): HomeMapper
    {
        if ($this->isEpisode()) {
            $this->setSeasonNumber()->setEpisodeNumber();
        }
        return $this;
    }

    /**
     * @return HomeMapper
     */
    protected function setEpisodeNumber(): HomeMapper
    {
        $this->episode = (new EpisodeNumberParser($this))->setPosition(1)->getValue();
        return $this;
    }

    /**
     * @return HomeMapper
     */
    protected function setSeasonNumber(): HomeMapper
    {
        $this->season = (new SeasonNumberParser($this))->setPosition(1)->getValue();
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSeasonNumber(): ?int
    {
        if ($this->isEpisode() && is_null($this->season)) {
            $this->setSeasonNumber();
        }
        return $this->season;
    }

    /**
     * @return int|null
     */
    public function getEpisodeNumber(): ?int
    {
        if ($this->isEpisode() && is_null($this->episode)) {
            $this->setEpisodeNumber();
        }
        return $this->episode;
    }
}
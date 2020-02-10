<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:22
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Parser\Home\ColorParser;
use ImdbScraper\Parser\Home\CountryParser;
use ImdbScraper\Parser\Home\DurationParser;
use ImdbScraper\Parser\Home\EpisodeNumberParser;
use ImdbScraper\Parser\Home\GenreParser;
use ImdbScraper\Parser\Home\LanguageParser;
use ImdbScraper\Parser\Home\OriginalTitleParser;
use ImdbScraper\Parser\Home\RecommendationParser;
use ImdbScraper\Parser\Home\ScoreParser;
use ImdbScraper\Parser\Home\SeasonNumberParser;
use ImdbScraper\Parser\Home\SoundParser;
use ImdbScraper\Parser\Home\TotalSeasonsParser;
use ImdbScraper\Parser\Home\TitleParser;
use ImdbScraper\Parser\Home\TvShowParser;
use ImdbScraper\Parser\Home\VoteParser;
use ImdbScraper\Parser\Home\YearParser;
use function strpos;
use function is_null;
use function explode;
use function end;
use function trim;

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
            /** @var TvShowParser $parser */
            $parser = (new TvShowParser($this))->setPosition(1);
            return $parser->getValue();
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
        $this->tvShow = strpos($this->content, static::SEASON_SPLITTER) !== false;
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
        /** @var TitleParser $parser */
        $parser = (new TitleParser($this))->setPosition(1);
        $title = $parser->getValue();
        if ($this->isEpisode()) {
            $parts = explode("\"", $title);
            $title = end($parts);
        } else {
            if (strpos($this->content, "(original title)") !== false) {
                /** @var OriginalTitleParser $parser */
                $parser = (new OriginalTitleParser($this))->setPosition(1);
                $title = $parser->getValue();
            } else {
                $parts = explode("(", $title);
                $title = trim($parts[0]);
            }
        }
        $this->title = trim($title);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        /** @var YearParser $parser */
        $parser = (new YearParser($this))->setPosition(2);
        return $parser->getValue();
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        /** @var DurationParser $parser */
        $parser = (new DurationParser($this))->setPosition(1);
        return $parser->getValue();
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        /** @var ScoreParser $parser */
        $parser = (new ScoreParser($this))->setPosition(1);
        $score = $parser->getValue();
        return $score ?? 0;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        /** @var VoteParser $parser */
        $parser = (new VoteParser($this))->setPosition(1);
        $votes = $parser->getValue();
        return $votes ?? 0;
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        /** @var ColorParser $parser */
        $parser = (new ColorParser($this))->setPosition(2);
        return $parser->getValue();
    }

    /**
     * @return array
     */
    public function getSounds(): array
    {
        /** @var SoundParser $parser */
        $parser = (new SoundParser($this))->setPosition(2);
        return $parser->getArray();
    }

    /**
     * @return array
     */
    public function getRecommendations(): array
    {
        /** @var RecommendationParser $parser */
        $parser = (new RecommendationParser($this))->setPosition(1);
        return $parser->getArray();
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        /** @var CountryParser $parser */
        $parser = (new CountryParser($this))->setPosition(2);
        return $parser->getArray();
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        /** @var LanguageParser $parser */
        $parser = (new LanguageParser($this))->setPosition(2);
        return $parser->getArray();
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        /** @var GenreParser $parser */
        $parser = (new GenreParser($this))->setPosition(2);
        return $parser->getArray();
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
        /** @var EpisodeNumberParser $parser */
        $parser = (new EpisodeNumberParser($this))->setPosition(1);
        $this->episode = $parser->getValue();
        return $this;
    }

    /**
     * @return HomeMapper
     */
    protected function setSeasonNumber(): HomeMapper
    {
        /** @var SeasonNumberParser $parser */
        $parser = (new SeasonNumberParser($this))->setPosition(1);
        $this->season = $parser->getValue();
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

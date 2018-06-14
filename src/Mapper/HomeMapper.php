<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:22
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Helper\CountryName;
use ImdbScraper\Helper\Cleaner;
use ImdbScraper\Parser\OriginalTitleParser;
use ImdbScraper\Parser\SeasonsParser;
use ImdbScraper\Parser\TitleParser;
use ImdbScraper\Parser\TvShowParser;
use ImdbScraper\Parser\YearParser;

class HomeMapper extends AbstractPageMapper
{

    protected const VOTES_PATTERN = '|<span class="small" itemprop="ratingCount">([^>]+)</span>|U';
    protected const COLOR_PATTERN = '|<a href=\"/search/title\?colors=([^>]+)\"itemprop=\'url\'>([^>]+)</a>|U';
    protected const SOUND_PATTERN = '|<a href=\"/search/title\?sound_mixes=([^>]+)\"itemprop=\'url\'>([^>]+)</a>|U';
    protected const COUNTRY_PATTERN = '|country_of_origin=([^>]+)>([^>]+)<|U';
    protected const LANGUAGE_PATTERN = '|primary_language=([^>]+)>([^>]+)<|U';
    protected const RECOMMENDATIONS_PATTERN = '|data-tconst=\"tt([0-9]{7})\"|U';
    protected const GENRE_PATTERN = '|genre/([^>]+)>([^>]+)<|U';
    protected const SEASON_PATTERN = '|>Season ([0-9]{1,2}) <|U';
    protected const EPISODE_PATTERN = '|> Episode ([0-9]{1,2})<|U';

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
        return (new SeasonsParser($this))->getTotal();
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
            return (new TvShowParser($this))->setPosition(1)->getInteger();
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
     * @param null|string $content
     * @return AbstractPageMapper
     * @throws \Exception
     */
    public function setContent(?string $content): AbstractPageMapper
    {
        parent::setContent($content);
        if (!$this->content) {
            throw new \Exception("Error fetching content from " . $this->getFullUrl());
        }
        return $this;
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
     * @throws \Exception
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
     * @throws \Exception
     */
    public function setTitle(): HomeMapper
    {
        $title = (new TitleParser($this))->setPosition(1)->getString();
        if ($this->isEpisode()) {
            $parts = explode("\"", $title);
            $title = end($parts);
        } else {
            if (strpos($this->content, "(original title)") !== false) {
                $title = (new OriginalTitleParser($this))->setPosition(1)->getString();
            } else {
                $parts = explode("(", $title);
                $title = trim($parts[0]);
            }
        }
        if (empty($title)) {
            throw new \Exception("Error fetching original title");
        }
        $this->title = Cleaner::clearField($title);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return (new YearParser($this))->setPosition(2)->getInteger();
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return (new DurationParser($this))->setPosition(1)->getInteger();
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        $score = (new ScoreParser($this))->setPosition(1)->getInteger();
        return $score ?? 0;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        $matches = array();
        preg_match_all(static::VOTES_PATTERN, $this->content, $matches);
        if (empty($matches[1][0])) {
            return 0;
        }
        return intval(filter_var($matches[1][0], FILTER_SANITIZE_NUMBER_INT));
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        $matches = array();
        preg_match_all(static::COLOR_PATTERN, $this->content, $matches);
        return (!empty($matches[2][0])) ? Cleaner::clearField(strip_tags($matches[2][0])) : null;
    }

    /**
     * @return array
     */
    public function getSounds(): array
    {
        $sounds = [];
        $matches = [];
        preg_match_all(static::SOUND_PATTERN, $this->content, $matches);
        if (array_key_exists(2, $matches) && is_array($matches[2])) {
            foreach ($matches[2] as $sound) {
                $sounds[] = Cleaner::clearField($sound);
            }
        }
        return $sounds;
    }

    /**
     * @return array
     */
    public function getRecommendations(): array
    {
        $recommended = [];
        $matches = [];
        preg_match_all(static::RECOMMENDATIONS_PATTERN, $this->content, $matches);
        if (array_key_exists(1, $matches) && is_array($matches[1])) {
            foreach ($matches[1] as $imdb) {
                $recommended[] = (int)Cleaner::clearField($imdb);
            }
        }
        return $recommended;
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        $countries = [];
        $matches = [];
        preg_match_all(static::COUNTRY_PATTERN, $this->content, $matches);
        if (array_key_exists(2, $matches) && is_array($matches[2])) {
            foreach ($matches[2] as $country) {
                $countries[] = CountryName::getMappedValue(Cleaner::clearField($country));
            }
        }
        return array_unique($countries);
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        $languages = [];
        $matches = [];
        preg_match_all(static::LANGUAGE_PATTERN, $this->content, $matches);
        if (array_key_exists(2, $matches) && is_array($matches[2])) {
            foreach ($matches[2] as $language) {
                $languages[] = Cleaner::clearField($language);
            }
        }
        return array_unique($languages);
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        $genres = [];
        $matches = [];
        preg_match_all(static::GENRE_PATTERN, $this->content, $matches);
        if (array_key_exists(2, $matches) && is_array($matches[2])) {
            foreach ($matches[2] as $key => $genre) {
                if (stripos($matches[1][$key], "tt_stry_gnr")) {
                    $genres[] = Cleaner::clearField($genre);
                }
            }
        }
        return array_unique($genres);
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
        $matches = [];
        preg_match_all(static::EPISODE_PATTERN, $this->content, $matches);
        if (!empty($matches[1][0]) && is_numeric($matches[1][0])) {
            $this->episode = (int)($matches[1][0]);
        }
        return $this;
    }

    /**
     * @return HomeMapper
     */
    protected function setSeasonNumber(): HomeMapper
    {
        $matches = [];
        preg_match_all(static::SEASON_PATTERN, $this->content, $matches);
        if (!empty($matches[1][0]) && is_numeric($matches[1][0])) {
            $this->season = (int)($matches[1][0]);
        }
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
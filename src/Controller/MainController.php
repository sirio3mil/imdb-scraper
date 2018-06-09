<?php

namespace ImdbScraper\Controller;

use ImdbScraper\Mapper\HomeMapper;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Mapper\KeywordMapper;
use ImdbScraper\Mapper\LocationMapper;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Mapper\ReleaseMapper;

class MainController
{

    /** @var int */
    protected $imdbNumber;

    /** @var HomeMapper */
    protected $homePage;

    /** @var ReleaseMapper */
    protected $releaseInfo;

    /** @var CastMapper */
    protected $credits;

    /** @var LocationMapper */
    protected $locations;

    /** @var KeywordMapper */
    protected $keywords;

    /** @var ParentalGuideMapper */
    protected $parentalGuide;

    public function __construct(int $imdbNumber)
    {
        $this->imdbNumber = $imdbNumber;
    }

    public function init(): void
    {
        $this->setHome()
            ->setTvShowFlags()
            ->setTitle()
            ->setImdbNumber()
            ->setReleaseInfo()
            ->setCredits()
            ->setLocations();
    }

    public function setHome(): MainController
    {
        $this->homePage = (new HomeMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getHome(): HomeMapper
    {
        if (!$this->homePage instanceof HomeMapper) {
            $this->setHome();
        }
        return $this->homePage;
    }

    public function getReleaseInfo(): ReleaseMapper
    {
        if (!$this->releaseInfo instanceof ReleaseMapper) {
            $this->setReleaseInfo();
        }
        return $this->releaseInfo;
    }

    public function setReleaseInfo(): MainController
    {
        $this->releaseInfo = (new ReleaseMapper())->setImdbNumber($this->imdbNumber);
        if ($this->getHome()->haveReleaseInfo()) {
            $this->releaseInfo->setContentFromUrl();
        }
        return $this;
    }

    public function getCredits(): CastMapper
    {
        if (!$this->credits instanceof CastMapper) {
            $this->setCredits();
        }
        return $this->credits;
    }

    public function setCredits(): MainController
    {
        $this->credits = (new CastMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getLocations(): LocationMapper
    {
        if (!$this->locations instanceof LocationMapper) {
            $this->setLocations();
        }
        return $this->locations;
    }

    public function setLocations(): MainController
    {
        $this->locations = (new LocationMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getKeywords(): KeywordMapper
    {
        if (!$this->keywords instanceof KeywordMapper) {
            $this->setKeywords();
        }
        return $this->keywords;
    }

    public function setKeywords(): MainController
    {
        $this->keywords = (new KeywordMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getParentalGuide(): ParentalGuideMapper
    {
        if (!$this->parentalGuide instanceof ParentalGuideMapper) {
            $this->setParentalGuide();
        }
        return $this->parentalGuide;
    }

    public function setParentalGuide(): MainController
    {
        $this->parentalGuide = (new ParentalGuideMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }
}
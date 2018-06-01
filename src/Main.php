<?php

namespace ImdbScraper;

use ImdbScraper\Pages\Home;
use ImdbScraper\Pages\Credits;
use ImdbScraper\Pages\Keywords;
use ImdbScraper\Pages\Locations;
use ImdbScraper\Pages\ParentalGuide;
use ImdbScraper\Pages\ReleaseInfo;

class Main
{

    /** @var int */
    protected $imdbNumber;

    /** @var Home */
    protected $homePage;

    /** @var ReleaseInfo */
    protected $releaseInfo;

    /** @var Credits */
    protected $credits;

    /** @var Locations */
    protected $locations;

    /** @var Keywords */
    protected $keywords;

    /** @var ParentalGuide */
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

    public function setHome(): Main
    {
        $this->homePage = (new Home())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getHome(): Home
    {
        if (!$this->homePage instanceof Home) {
            $this->setHome();
        }
        return $this->homePage;
    }

    public function getReleaseInfo(): ReleaseInfo
    {
        if (!$this->releaseInfo instanceof ReleaseInfo) {
            $this->setReleaseInfo();
        }
        return $this->releaseInfo;
    }

    public function setReleaseInfo(): Main
    {
        $this->releaseInfo = (new ReleaseInfo())->setImdbNumber($this->imdbNumber);
        if ($this->getHome()->haveReleaseInfo()) {
            $this->releaseInfo->setContentFromUrl();
        }
        return $this;
    }

    public function getCredits(): Credits
    {
        if (!$this->credits instanceof Credits) {
            $this->setCredits();
        }
        return $this->credits;
    }

    public function setCredits(): Main
    {
        $this->credits = (new Credits())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getLocations(): Locations
    {
        if (!$this->locations instanceof Locations) {
            $this->setLocations();
        }
        return $this->locations;
    }

    public function setLocations(): Main
    {
        $this->locations = (new Locations())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getKeywords(): Keywords
    {
        if (!$this->keywords instanceof Keywords) {
            $this->setKeywords();
        }
        return $this->keywords;
    }

    public function setKeywords(): Main
    {
        $this->keywords = (new Keywords())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    public function getParentalGuide(): ParentalGuide
    {
        if (!$this->parentalGuide instanceof ParentalGuide) {
            $this->setParentalGuide();
        }
        return $this->parentalGuide;
    }

    public function setParentalGuide(): Main
    {
        $this->parentalGuide = (new ParentalGuide())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }
}
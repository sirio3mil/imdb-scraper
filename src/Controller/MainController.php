<?php

namespace ImdbScraper\Controller;

use Exception;
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

    /**
     * @throws Exception
     */
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

    /**
     * @return MainController
     * @throws Exception
     */
    public function setHome(): MainController
    {
        $this->homePage = (new HomeMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    /**
     * @return HomeMapper
     * @throws Exception
     */
    public function getHome(): HomeMapper
    {
        if (!$this->homePage instanceof HomeMapper) {
            $this->setHome();
        }
        return $this->homePage;
    }

    /**
     * @return ReleaseMapper
     * @throws Exception
     */
    public function getReleaseInfo(): ReleaseMapper
    {
        if (!$this->releaseInfo instanceof ReleaseMapper) {
            $this->setReleaseInfo();
        }
        return $this->releaseInfo;
    }

    /**
     * @return MainController
     * @throws Exception
     */
    public function setReleaseInfo(): MainController
    {
        $this->releaseInfo = (new ReleaseMapper())->setImdbNumber($this->imdbNumber);
        if ($this->getHome()->haveReleaseInfo()) {
            $this->releaseInfo->setContentFromUrl();
        }
        return $this;
    }

    /**
     * @return CastMapper
     * @throws Exception
     */
    public function getCredits(): CastMapper
    {
        if (!$this->credits instanceof CastMapper) {
            $this->setCredits();
        }
        return $this->credits;
    }

    /**
     * @return MainController
     * @throws Exception
     */
    public function setCredits(): MainController
    {
        $this->credits = (new CastMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    /**
     * @return LocationMapper
     * @throws Exception
     */
    public function getLocations(): LocationMapper
    {
        if (!$this->locations instanceof LocationMapper) {
            $this->setLocations();
        }
        return $this->locations;
    }

    /**
     * @return MainController
     * @throws Exception
     */
    public function setLocations(): MainController
    {
        $this->locations = (new LocationMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    /**
     * @return KeywordMapper
     * @throws Exception
     */
    public function getKeywords(): KeywordMapper
    {
        if (!$this->keywords instanceof KeywordMapper) {
            $this->setKeywords();
        }
        return $this->keywords;
    }

    /**
     * @return MainController
     * @throws Exception
     */
    public function setKeywords(): MainController
    {
        $this->keywords = (new KeywordMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }

    /**
     * @return ParentalGuideMapper
     * @throws Exception
     */
    public function getParentalGuide(): ParentalGuideMapper
    {
        if (!$this->parentalGuide instanceof ParentalGuideMapper) {
            $this->setParentalGuide();
        }
        return $this->parentalGuide;
    }

    /**
     * @return MainController
     * @throws Exception
     */
    public function setParentalGuide(): MainController
    {
        $this->parentalGuide = (new ParentalGuideMapper())->setImdbNumber($this->imdbNumber)->setContentFromUrl();
        return $this;
    }
}
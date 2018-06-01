<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 13:28
 */

namespace ImdbScraper\Pages;

use ImdbScraper\Utils\Cleaner;
use ImdbScraper\Utils\Getter;

class Page
{
    /** @var string */
    protected $content;

    /** @var string */
    protected $baseUrl;

    /** @var string */
    protected $fullUrl;

    /** @var string */
    protected $folder;

    /** @var int */
    protected $imdbNumber;

    /**
     * @param int $imdbNumber
     * @return Page
     */
    public function setImdbNumber(int $imdbNumber): Page
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    /**
     * @param string $folder
     * @return Page
     */
    public function setFolder(string $folder): Page
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content ? $this->content : '';
    }

    /**
     * @param null|string $content
     * @return Page
     */
    public function setContent(?string $content): Page
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Page
     * @throws \Exception
     */
    public function setContentFromUrl(): Page
    {
        $this->setContent(Cleaner::clearText(Getter::getUrlContent($this->getFullUrl())));
        return $this;
    }

    /**
     * @return string
     */
    public function getFullUrl(): string
    {
        if (!$this->fullUrl) {
            $this->setFullUrl();
        }
        return $this->fullUrl;
    }

    /**
     * @return Page
     */
    public function setFullUrl(): Page
    {
        $this->fullUrl = $this->getBaseUrl();
        if ($this->folder) {
            $this->fullUrl .= $this->folder;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        if (!$this->baseUrl) {
            $this->setBaseUrl();
        }
        return $this->baseUrl;
    }

    /**
     * @return Page
     */
    protected function setBaseUrl(): Page
    {
        $this->baseUrl = 'https://www.imdb.com/title/tt' . str_pad($this->imdbNumber, 7, 0, STR_PAD_LEFT) . '/';
        return $this;
    }
}
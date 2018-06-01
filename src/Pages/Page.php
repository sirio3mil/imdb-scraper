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
    protected $content;

    protected $baseUrl;

    protected $fullUrl;

    protected $folder;

    protected $imdbNumber;

    public function setImdbNumber(int $imdbNumber): Page
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    public function setFolder(string $folder): Page
    {
        $this->folder = $folder;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content ? $this->content : '';
    }

    public function setContent(?string $content): Page
    {
        $this->content = $content;
        return $this;
    }

    public function setContentFromUrl(): Page
    {
        $this->setContent(Cleaner::clearText(Getter::getUrlContent($this->getFullUrl())));
        return $this;
    }

    public function getFullUrl(): string
    {
        if (!$this->fullUrl) {
            $this->setFullUrl();
        }
        return $this->fullUrl;
    }

    public function setFullUrl(): Page
    {
        $this->fullUrl = $this->getBaseUrl();
        if ($this->folder) {
            $this->fullUrl .= $this->folder;
        }
        return $this;
    }

    public function getBaseUrl(): string
    {
        if (!$this->baseUrl) {
            $this->setBaseUrl();
        }
        return $this->baseUrl;
    }

    protected function setBaseUrl(): Page
    {
        $this->baseUrl = 'https://www.imdb.com/title/tt' . str_pad($this->imdbNumber, 7, 0, STR_PAD_LEFT) . '/';
        return $this;
    }
}
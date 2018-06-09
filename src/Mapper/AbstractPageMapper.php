<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 13:28
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Helper\Cleaner;
use ImdbScraper\Helper\Getter;

abstract class AbstractPageMapper
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
     * @return AbstractPageMapper
     */
    public function setImdbNumber(int $imdbNumber): AbstractPageMapper
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    /**
     * @param string $folder
     * @return AbstractPageMapper
     */
    public function setFolder(string $folder): AbstractPageMapper
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content ?? '';
    }

    /**
     * @param null|string $content
     * @return AbstractPageMapper
     */
    public function setContent(?string $content): AbstractPageMapper
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return AbstractPageMapper
     * @throws \Exception
     */
    public function setContentFromUrl(): AbstractPageMapper
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
     * @return AbstractPageMapper
     */
    public function setFullUrl(): AbstractPageMapper
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
     * @return AbstractPageMapper
     */
    protected function setBaseUrl(): AbstractPageMapper
    {
        $this->baseUrl = 'https://www.imdb.com/title/tt' . str_pad($this->imdbNumber, 7, 0, STR_PAD_LEFT) . '/';
        return $this;
    }
}
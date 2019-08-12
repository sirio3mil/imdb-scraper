<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:07
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Parser\Cast\CastParser;
use ImdbScraper\Parser\Cast\DirectorParser;
use ImdbScraper\Parser\Cast\WriterParser;

class CastMapper extends AbstractPageMapper
{

    /**
     * @var string|null
     */
    private $contentDirector;

    /**
     * @var string|null
     */
    private $contentWriter;

    /**
     * @var string|null
     */
    private $contentCast;

    public function __construct()
    {
        $this->setFolder('fullcredits');
    }

    /**
     * @param null|string $content
     * @return AbstractPageMapper
     */
    public function setContent(?string $content): AbstractPageMapper
    {
        $this->content = $content;

        $data = explode("dataHeaderWithBorder" , $this->getContent());

        $this->contentDirector = $data[1] ?? null;
        $this->contentWriter = $data[2] ?? null;
        $this->contentCast = $data[3] ?? null;

        return $this;
    }

    /**
     * @return PersonIterator
     */
    public function getDirectors(): PersonIterator
    {
        /** @var PersonIterator $iterator */
        $iterator = (new DirectorParser($this))->getRegexIterator();
        return $iterator;
    }

    /**
     * @return PersonIterator
     */
    public function getWriters(): PersonIterator
    {
        /** @var PersonIterator $iterator */
        $iterator = (new WriterParser($this))->getRegexIterator();
        return $iterator;
    }

    /**
     * @return CastIterator
     */
    public function getCast(): CastIterator
    {
        /** @var CastIterator $iterator */
        $iterator = (new CastParser($this))->getRegexIterator();
        return $iterator;
    }

    /**
     * @return string|null
     */
    public function getContentDirector(): ?string
    {
        return $this->contentDirector;
    }

    /**
     * @return string|null
     */
    public function getContentWriter(): ?string
    {
        return $this->contentWriter;
    }

    /**
     * @return string|null
     */
    public function getContentCast(): ?string
    {
        return $this->contentCast;
    }
}
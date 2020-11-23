<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:14
 */

namespace ImdbScraper\Parser;

use ImdbScraper\Mapper\AbstractPageMapper;
use function preg_match_all;

abstract class AbstractParser
{
    /** @var AbstractPageMapper */
    protected $pageMapper;

    /** @var string */
    protected $content;

    public function __construct(AbstractPageMapper $pageMapper)
    {
        $this->setPageMapper($pageMapper);
        $this->setContent($pageMapper->getContent());
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content ?? '';
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return AbstractPageMapper
     */
    protected function getPageMapper(): AbstractPageMapper
    {
        return $this->pageMapper;
    }

    /**
     * @param AbstractPageMapper $pageMapper
     * @return AbstractParser
     */
    protected function setPageMapper(AbstractPageMapper $pageMapper): AbstractParser
    {
        $this->pageMapper = $pageMapper;
        return $this;
    }

    /**
     * @return array
     */
    protected function getMatches(): array
    {
        $matches = [];
        preg_match_all($this->getPattern(), $this->getContent(), $matches);
        return $matches;
    }

    /**
     * @return string
     */
    abstract public function getPattern(): string;
}
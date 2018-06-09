<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:14
 */

namespace ImdbScraper\Parser;


use ImdbScraper\Iterator\AbstractRegexIterator;
use ImdbScraper\Mapper\AbstractPageMapper;

abstract class AbstractParser
{
    /** @var AbstractPageMapper */
    protected $pageMapper;

    /** @var AbstractRegexIterator */
    protected $iterator;

    /** @var string */
    protected $iteratorClassName;

    public function __construct(AbstractPageMapper $pageMapper, string $iteratorClassName)
    {
        $this->setPageMapper($pageMapper)->setIteratorClassName($iteratorClassName);
    }

    /**
     * @return AbstractPageMapper
     */
    protected function getPageMapper(): AbstractPageMapper
    {
        return $this->pageMapper;
    }

    /**
     * @param mixed $iteratorClassName
     * @return AbstractParser
     */
    protected function setIteratorClassName($iteratorClassName): AbstractParser
    {
        $this->iteratorClassName = $iteratorClassName;
        return $this;
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
     * @return AbstractRegexIterator
     */
    public function getIterator(): AbstractRegexIterator
    {
        /** @var array $matches */
        $matches = [];
        /** @var string $content */
        $content = $this->pageMapper->getContent();
        if ($content) {
            preg_match_all(static::PATTERN, $content, $matches);
        }
        return (new $this->iteratorClassName())->appendAll($matches);
    }
}
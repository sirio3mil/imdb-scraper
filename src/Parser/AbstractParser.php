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
     * @param mixed $iteratorClassName
     * @return AbstractParser
     */
    protected function setIteratorClassName($iteratorClassName): AbstractParser
    {
        $this->iteratorClassName = $iteratorClassName;
        return $this;
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
}
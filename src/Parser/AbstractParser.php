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

    public function __construct(AbstractPageMapper $pageMapper)
    {
        $this->setPageMapper($pageMapper);
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
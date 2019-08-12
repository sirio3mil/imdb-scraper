<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:41
 */

namespace ImdbScraper\Parser;

use ImdbScraper\Iterator\AbstractRegexIterator;
use ImdbScraper\Mapper\AbstractPageMapper;

abstract class AbstractIteratorParser extends AbstractParser
{
    /** @var AbstractRegexIterator */
    protected $regexIterator;

    public function __construct(AbstractPageMapper $pageMapper, AbstractRegexIterator $regexIterator)
    {
        $this->regexIterator = $regexIterator;
        parent::__construct($pageMapper);
    }

    /**
     * @return AbstractRegexIterator
     */
    public function getRegexIterator(): AbstractRegexIterator
    {
        return $this->regexIterator->appendAll($this->getMatches());
    }
}

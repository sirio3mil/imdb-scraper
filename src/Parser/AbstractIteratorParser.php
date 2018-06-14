<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:41
 */

namespace ImdbScraper\Parser;


abstract class AbstractIteratorParser extends AbstractParser
{
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
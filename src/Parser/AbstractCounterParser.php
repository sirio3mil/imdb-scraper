<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:13
 */

namespace ImdbScraper\Parser;


class AbstractCounterParser extends AbstractParser
{
    /**
     * @return null|int
     */
    public function getTotal(): int
    {
        /** @var array $matches */
        $matches = [];
        /** @var string $content */
        $content = $this->pageMapper->getContent();
        if ($content) {
            preg_match_all(static::PATTERN, $content, $matches);
        }
        if ($matches) {
            return count($matches[0]);
        }
        return 0;
    }
}
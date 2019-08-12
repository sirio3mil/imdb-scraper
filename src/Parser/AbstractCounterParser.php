<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:13
 */

namespace ImdbScraper\Parser;

use function count;

abstract class AbstractCounterParser extends AbstractParser
{
    /**
     * @return null|int
     */
    public function getTotal(): int
    {
        $matches = $this->getMatches();
        if ($matches) {
            return count($matches[0]);
        }
        return 0;
    }
}

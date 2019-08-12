<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:23
 */

namespace ImdbScraper\Parser;

use function array_key_exists;
use function is_array;
use function array_unique;

abstract class AbstractArrayParser extends AbstractPositionParser
{
    /**
     * @return array
     */
    public function getArray(): array
    {
        /** @var array $values */
        $values = [];
        /** @var array $matches */
        $matches = $this->getMatches();
        /** @var int $index */
        $index = $this->getPosition();
        if ($matches) {
            if (array_key_exists($index, $matches) && is_array($matches[$index])) {
                foreach ($matches[$index] as $value) {
                    $values[] = static::validateValue($value);
                }
            }
        }
        return array_unique($values);
    }
}

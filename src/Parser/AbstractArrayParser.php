<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:23
 */

namespace ImdbScraper\Parser;


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
        $matches = [];
        /** @var string $content */
        $content = $this->pageMapper->getContent();
        /** @var int $index */
        $index = $this->getPosition();
        if ($content) {
            preg_match_all(static::PATTERN, $content, $matches);
            if (array_key_exists($index, $matches) && is_array($matches[$index])) {
                foreach ($matches[$index] as $value) {
                    $values[] = static::validateValue($value);
                }
            }
        }
        return array_unique($values);
    }
}
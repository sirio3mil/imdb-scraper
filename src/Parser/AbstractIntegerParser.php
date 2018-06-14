<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:57
 */

namespace ImdbScraper\Parser;


class AbstractIntegerParser extends AbstractValueParser
{
    /**
     * @return null|int
     */
    public function getInteger(): ?int
    {
        /** @var array $matches */
        $matches = [];
        /** @var string $content */
        $content = $this->pageMapper->getContent();
        if ($content) {
            preg_match_all(static::PATTERN, $content, $matches);
        }
        $value = null;
        $index = $this->getPosition();
        if ($matches && array_key_exists($index, $matches) && !empty($matches[$index][0])) {
            $value = intval(filter_var(trim($matches[$index][0]), FILTER_SANITIZE_NUMBER_INT));
        }
        return $value;
    }
}
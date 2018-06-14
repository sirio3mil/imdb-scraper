<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:43
 */

namespace ImdbScraper\Parser;


class AbstractStringParser extends AbstractValueParser
{
    /**
     * @return null|string
     */
    public function getString(): ?string
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
            $value = html_entity_decode(trim($matches[$index][0]), ENT_QUOTES);
        }
        return $value;
    }
}
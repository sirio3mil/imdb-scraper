<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:55
 */

namespace ImdbScraper\Parser;


abstract class AbstractValueParser extends AbstractParser
{
    /** @var int */
    protected $position;

    public function getValue()
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
            $value = static::validateValue($matches[$index][0]);
        }
        return $value;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }
    
    /**
     * @param int $position
     * @return AbstractValueParser
     */
    public function setPosition(int $position): AbstractValueParser
    {
        $this->position = $position;
        return $this;
    }

    protected static abstract function validateValue($value);
}
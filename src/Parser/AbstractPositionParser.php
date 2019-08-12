<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:24
 */

namespace ImdbScraper\Parser;

abstract class AbstractPositionParser extends AbstractParser implements ValueValidator
{
    /** @var int */
    protected $position;

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
    public function setPosition(int $position): AbstractPositionParser
    {
        $this->position = $position;
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:55
 */

namespace ImdbScraper\Parser;


class AbstractValueParser extends AbstractParser
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
    public function setPosition(int $position): AbstractValueParser
    {
        $this->position = $position;
        return $this;
    }
}
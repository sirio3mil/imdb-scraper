<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 07/06/2018
 * Time: 22:31
 */

namespace ImdbScraper\Iterator;


class EpisodeIterator extends AbstractRegexIterator
{
    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->modelClassName = 'ImdbScraper\Model\Episode';
    }
}
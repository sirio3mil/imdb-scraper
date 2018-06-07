<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 07/06/2018
 * Time: 22:31
 */

namespace ImdbScraper\Lists;


class EpisodeList extends RegexList
{
    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->className = 'ImdbScraper\Model\Episode';
    }
}
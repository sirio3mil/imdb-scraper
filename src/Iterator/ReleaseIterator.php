<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 9:54
 */

namespace ImdbScraper\Iterator;


class ReleaseIterator extends AbstractRegexIterator
{
    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->modelClassName = 'ImdbScraper\Model\Release';
    }
}
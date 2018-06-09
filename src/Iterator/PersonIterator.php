<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 31/05/2018
 * Time: 13:18
 */

namespace ImdbScraper\Iterator;

class PersonIterator extends AbstractRegexIterator
{

    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->modelClassName = 'ImdbScraper\Model\People';
    }
}
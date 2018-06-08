<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/06/2018
 * Time: 23:46
 */

namespace ImdbScraper\Lists;


class CertificateList extends RegexList
{
    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->className = 'ImdbScraper\Model\Certificate';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/06/2018
 * Time: 23:46
 */

namespace ImdbScraper\Iterator;


class CertificateIterator extends AbstractRegexIterator
{
    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->modelClassName = 'ImdbScraper\Model\Certificate';
    }
}
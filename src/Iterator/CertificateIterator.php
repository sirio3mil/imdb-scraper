<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 08/06/2018
 * Time: 23:46
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\Certificate;

class CertificateIterator extends AbstractRegexIterator
{
    public function __construct(Certificate $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new Certificate();
        }
        parent::__construct($regexModel);
    }
}
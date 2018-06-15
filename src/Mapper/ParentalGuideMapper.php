<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:11
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Parser\ParentalGuide\CertificateParser;

class ParentalGuideMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder('parentalguide');
    }

    /**
     * @return CertificateIterator
     */
    public function getCertificates(): CertificateIterator
    {
        return (new CertificateParser($this))->getRegexIterator();
    }
}
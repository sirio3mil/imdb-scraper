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
use function strtolower;

class ParentalGuideMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder(strtolower('parentalGuide'));
    }

    /**
     * @return CertificateIterator
     */
    public function getCertificates(): CertificateIterator
    {
        /** @var CertificateIterator $iterator */
        $iterator = (new CertificateParser($this))->getRegexIterator();
        return $iterator;
    }
}

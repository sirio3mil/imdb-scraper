<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:11
 */

namespace ImdbScraper\Mapper;


use ImdbScraper\Iterator\CertificateIterator;

class ParentalGuideMapper extends AbstractPageMapper
{

    /** @var string */
    protected const CERTIFICATE_PATTERN = '|<a href="/search/title\?certificates=([A-Z]+):([^>]+)">([^>]+):([^>]+)</a>([^<]*)<|U';

    public function __construct()
    {
        $this->setFolder('parentalguide');
    }

    /**
     * @return CertificateIterator
     */
    public function getCertificates(): CertificateIterator
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::CERTIFICATE_PATTERN, $this->content, $matches);
        }
        return (new CertificateIterator())->appendAll($matches);
    }
}
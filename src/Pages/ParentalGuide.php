<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:11
 */

namespace ImdbScraper\Pages;


use ImdbScraper\Lists\CertificateList;

class ParentalGuide extends Page
{

    /** @var string */
    protected const CERTIFICATE_PATTERN = '|<a href="/search/title\?certificates=([A-Z]+):([^>]+)">([^>]+):([^>]+)</a>([^<]*)<|U';

    public function __construct()
    {
        $this->setFolder('parentalguide');
    }

    /**
     * @return CertificateList
     */
    public function getCertificates(): CertificateList
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::CERTIFICATE_PATTERN, $this->content, $matches);
        }
        return (new CertificateList())->appendAll($matches);
    }
}
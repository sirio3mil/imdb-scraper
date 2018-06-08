<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:46
 */

namespace Tests\Feature;

use ImdbScraper\Lists\CertificateList;
use ImdbScraper\Model\Certificate;
use ImdbScraper\Pages\ParentalGuide;
use PHPUnit\Framework\TestCase;

class ParentalGuideTest extends TestCase
{

    /** @var ParentalGuide $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new ParentalGuide())->setImdbNumber(5463162)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCertificates()
    {
        /** @var int $found */
        $found = 0;
        /** @var CertificateList $certificates */
        $certificates = $this->imdbScrapper->getCertificates();
        /** @var Certificate $certificate */
        foreach ($certificates as $certificate) {
            switch ($certificate->getIsoCountryCode()) {
                case 'BR':
                    ++$found;
                    $this->assertThat($certificate->getCertification(), $this->logicalOr(
                        $this->equalTo('18'),
                        $this->equalTo('16')
                    ));
                    $this->assertThat($certificate->getDetails(), $this->logicalOr(
                        $this->equalTo('original rating'),
                        $this->equalTo('re-rating')
                    ));
                    $this->assertEquals('Brazil', $certificate->getCountryName());
                    break;
            }
        }
        $this->assertEquals(2, $found);
    }
}

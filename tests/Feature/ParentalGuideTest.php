<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:46
 */

namespace Tests\Feature;

use Exception;
use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Model\Certificate;
use ImdbScraper\Mapper\ParentalGuideMapper;
use PHPUnit\Framework\TestCase;

class ParentalGuideTest extends TestCase
{

    /** @var ParentalGuideMapper $imdbScrapper */
    protected $imdbScrapper;

    /**
     * ParentalGuideTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     * @throws Exception
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new ParentalGuideMapper())->setImdbNumber(5463162)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCertificates()
    {
        /** @var int $found */
        $found = 0;
        /** @var CertificateIterator $certificates */
        $certificates = $this->imdbScrapper->getCertificates();
        /** @var Certificate $certificate */
        foreach ($certificates as $certificate) {
            switch ($certificate->getIsoCountryCode()) {
                case 'BR':
                    ++$found;
                    $this->assertThat($certificate->getCertification(), $this->logicalOr(
                        $this->equalTo('18'),
                        $this->equalTo('16'),
                        $this->equalTo('14')
                    ));
                    $this->assertThat($certificate->getDetails(), $this->logicalOr(
                        $this->equalTo('original rating'),
                        $this->equalTo('re-rating'),
                        $this->equalTo('edited version')
                    ));
                    $this->assertEquals('Brazil', $certificate->getCountryName());
                    break;
            }
        }
        $this->assertEquals(3, $found);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:46
 */

namespace Tests\Feature;

use ImdbScraper\Lists\ReleaseList;
use ImdbScraper\Model\Release;
use ImdbScraper\Pages\ReleaseInfo;
use PHPUnit\Framework\TestCase;

class ReleaseInfoTest extends TestCase
{

    /** @var ReleaseInfo $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new ReleaseInfo())->setImdbNumber(5463162)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetAlsoKnownAs()
    {

    }

    public function testGetReleaseDates()
    {
        $found = 0;
        /** @var ReleaseList $releases */
        $releases = $this->imdbScrapper->getReleaseDates();
        /** @var Release $release */
        foreach ($releases as $release) {
            switch ($release->getCountry()) {
                case 'Bangladesh':
                    ++$found;
                    $this->assertThat($release->getDate()->format('Y-m-d'), $this->logicalOr(
                        $this->equalTo('2018-05-18'),
                        $this->equalTo('2018-05-17')
                    ));
                    $this->assertThat($release->getDetails(), $this->logicalOr(
                        $this->equalTo([]),
                        $this->equalTo(['Star Cineplex Premiere Festival', 'Star Cineplex premiere'])
                    ));
                    break;
            }
        }
        $this->assertGreaterThanOrEqual(2, $found);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/05/2018
 * Time: 12:46
 */

namespace Tests\Feature;

use ImdbScraper\Iterator\AlsoKnownAsIterator;
use ImdbScraper\Iterator\ReleaseIterator;
use ImdbScraper\Model\AlsoKnownAs;
use ImdbScraper\Model\Release;
use ImdbScraper\Mapper\ReleaseMapper;
use PHPUnit\Framework\TestCase;

class ReleaseInfoTest extends TestCase
{

    /** @var ReleaseMapper $imdbScrapper */
    protected $imdbScrapper;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->imdbScrapper = (new ReleaseMapper())->setImdbNumber(5463162)->setContentFromUrl();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetAlsoKnownAs()
    {
        /** @var int $found */
        $found = 0;
        /** @var AlsoKnownAsIterator $alsoKnownAs */
        $alsoKnownAs = $this->imdbScrapper->getAlsoKnownAs();
        /** @var AlsoKnownAs $known */
        foreach ($alsoKnownAs as $known) {
            switch ($known->getCountry()) {
                case 'Bulgaria':
                    ++$found;
                    $this->assertThat($known->getTitle(), $this->logicalOr(
                        $this->equalTo('Дедпул 2')
                    ));
                    $this->assertThat($known->getDescription(), $this->logicalOr(
                        $this->equalTo('Bulgarian title')
                    ));
                    break;
            }
        }
        $this->assertGreaterThanOrEqual(1, $found);
    }

    public function testGetReleaseDates()
    {
        /** @var int $found */
        $found = 0;
        /** @var ReleaseIterator $releases */
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

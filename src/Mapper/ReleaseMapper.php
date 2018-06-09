<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 13:27
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Iterator\AlsoKnownAsIterator;
use ImdbScraper\Iterator\ReleaseIterator;

class ReleaseMapper extends AbstractPageMapper
{

    protected const RELEASE_DATE_PATTERN = '|<td><a href=\"([^>]+)\">([^>]+)</a></td><td class=\"release_date\">([^>]+)</td><td>([^>]*)</td>|U';
    protected const OTHER_TITLES_PATTERN = '|<tr class="([^>]+)"><td>([^>]+)</td><td>([^>]+)</td></tr>|U';

    public function __construct()
    {
        $this->setFolder('releaseinfo');
    }

    /**
     * @return ReleaseIterator
     */
    public function getReleaseDates(): ReleaseIterator
    {
        $matches = [];
        preg_match_all(static::RELEASE_DATE_PATTERN, $this->getContent(), $matches);
        return (new ReleaseIterator())->appendAll($matches);
    }

    /**
     * @return AlsoKnownAsIterator
     */
    public function getAlsoKnownAs(): AlsoKnownAsIterator
    {
        $matches = [];
        preg_match_all(static::OTHER_TITLES_PATTERN, $this->getContent(), $matches);
        return (new AlsoKnownAsIterator())->appendAll($matches);
    }
}
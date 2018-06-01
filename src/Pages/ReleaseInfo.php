<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 13:27
 */

namespace ImdbScraper\Pages;

use ImdbScraper\Lists\AlsoKnownAsList;
use ImdbScraper\Lists\ReleaseList;

class ReleaseInfo extends Page
{

    protected const RELEASE_DATE_PATTERN = '|<td><a href=\"([^>]+)\">([^>]+)</a></td><td class=\"release_date\">([^>]+)</td><td>([^>]*)</td>|U';
    protected const OTHER_TITLES_PATTERN = '|<tr class="([^>]+)"><td>([^>]+)</td><td>([^>]+)</td></tr>|U';

    public function __construct()
    {
        $this->setFolder('releaseinfo');
    }

    /**
     * @return ReleaseList
     */
    public function getReleaseDates(): ReleaseList
    {
        $matches = [];
        preg_match_all(static::RELEASE_DATE_PATTERN, $this->getContent(), $matches);
        return (new ReleaseList())->appendAll($matches);
    }

    /**
     * @return AlsoKnownAsList
     */
    public function getAlsoKnownAs(): AlsoKnownAsList
    {
        $matches = [];
        preg_match_all(static::OTHER_TITLES_PATTERN, $this->getContent(), $matches);
        return (new AlsoKnownAsList())->appendAll($matches);
    }
}
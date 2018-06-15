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
use ImdbScraper\Parser\Release\AlsoKnownAsParser;
use ImdbScraper\Parser\Release\ReleaseParser;

class ReleaseMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder('releaseinfo');
    }

    /**
     * @return ReleaseIterator
     */
    public function getReleaseDates(): ReleaseIterator
    {
        return (new ReleaseParser($this))->getRegexIterator();
    }

    /**
     * @return AlsoKnownAsIterator
     */
    public function getAlsoKnownAs(): AlsoKnownAsIterator
    {
        return (new AlsoKnownAsParser())->getRegexIterator();
    }
}
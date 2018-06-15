<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:07
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Parser\Cast\CastParser;
use ImdbScraper\Parser\Cast\DirectorParser;
use ImdbScraper\Parser\Cast\WriterParser;

class CastMapper extends AbstractPageMapper
{

    public function __construct()
    {
        $this->setFolder('fullcredits');
    }

    /**
     * @return PersonIterator
     */
    public function getDirectors(): PersonIterator
    {
        return (new DirectorParser($this))->getRegexIterator();
    }

    /**
     * @return PersonIterator
     */
    public function getWriters(): PersonIterator
    {
        return (new WriterParser($this))->getRegexIterator();
    }

    /**
     * @return CastIterator
     */
    public function getCast(): CastIterator
    {
        return (new CastParser($this))->getRegexIterator();
    }
}
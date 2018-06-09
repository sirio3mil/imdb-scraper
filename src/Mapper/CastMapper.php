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
use ImdbScraper\Parser\CastParser;
use ImdbScraper\Parser\DirectorParser;
use ImdbScraper\Parser\WriterParser;

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
        return (new DirectorParser($this))->getIterator();
    }

    /**
     * @return PersonIterator
     */
    public function getWriters(): PersonIterator
    {
        return (new WriterParser($this))->getIterator();
    }

    /**
     * @return CastIterator
     */
    public function getCast(): CastIterator
    {
        return (new CastParser($this))->getIterator();
    }
}
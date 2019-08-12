<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:21
 */

namespace ImdbScraper\Parser\Cast;

use ImdbScraper\Iterator\PersonIterator;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class DirectorParser extends AbstractIteratorParser
{

    public function __construct(CastMapper $pageMapper)
    {
        parent::__construct($pageMapper, new PersonIterator());

        $this->setContent($pageMapper->getContentDirector());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href="/name/nm([0-9]+)/">([^>]+)</a>|U';
    }
}

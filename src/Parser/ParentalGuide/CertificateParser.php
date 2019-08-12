<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:28
 */

namespace ImdbScraper\Parser\ParentalGuide;

use ImdbScraper\Iterator\CertificateIterator;
use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class CertificateParser extends AbstractIteratorParser
{

    public function __construct(ParentalGuideMapper $pageMapper)
    {
        parent::__construct($pageMapper, new CertificateIterator());
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href="/search/title\?certificates=([A-Z]+):([^>]+)">([^>]+):([^>]+)</a>([^<]*)<|U';
    }
}

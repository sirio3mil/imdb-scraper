<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 15/06/2018
 * Time: 9:28
 */

namespace ImdbScraper\Parser\ParentalGuide;


use ImdbScraper\Mapper\ParentalGuideMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class CertificateParser extends AbstractIteratorParser
{

    /** @var string */
    protected const PATTERN = '|<a href="/search/title\?certificates=([A-Z]+):([^>]+)">([^>]+):([^>]+)</a>([^<]*)<|U';

    public function __construct(ParentalGuideMapper $pageMapper)
    {
        parent::__construct($pageMapper, 'ImdbScraper\Iterator\CertificateIterator');
    }
}
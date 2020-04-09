<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 09/06/2018
 * Time: 23:25
 */

namespace ImdbScraper\Parser\Cast;

use ImdbScraper\Iterator\CastIterator;
use ImdbScraper\Mapper\CastMapper;
use ImdbScraper\Parser\AbstractIteratorParser;

class CastParser extends AbstractIteratorParser
{

    public function __construct(CastMapper $pageMapper)
    {
        parent::__construct($pageMapper, new CastIterator());

        $content = $pageMapper->getContentCast() ?? '';
        $this->setContent($content);
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href="/name/nm([0-9]+)/">([^>]+)</a></td>' .
            '<td class="ellipsis">(.*)</td><td class="character">(.*)</td>|U';
    }
}

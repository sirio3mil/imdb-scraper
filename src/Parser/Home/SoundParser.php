<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:28
 */

namespace ImdbScraper\Parser\Home;

use ImdbScraper\Parser\AbstractArrayParser;
use ImdbScraper\Parser\StringValidator;

class SoundParser extends AbstractArrayParser
{
    use StringValidator;

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|<a href="/search/title\?sound_mixes=([^>]+)">([^>]+)</a>|U';
    }
}

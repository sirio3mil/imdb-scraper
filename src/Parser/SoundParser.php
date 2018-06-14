<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:28
 */

namespace ImdbScraper\Parser;


class SoundParser extends AbstractArrayParser
{
    use StringValidator;

    /** @var string */
    protected const PATTERN = '|<a href=\"/search/title\?sound_mixes=([^>]+)\"itemprop=\'url\'>([^>]+)</a>|U';
}
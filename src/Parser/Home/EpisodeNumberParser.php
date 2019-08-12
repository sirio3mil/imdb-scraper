<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:44
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractIntegerParser;

class EpisodeNumberParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|> Episode ([0-9]{1,2})<|U';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:30
 */

namespace ImdbScraper\Parser\Home;

use ImdbScraper\Parser\AbstractArrayParser;
use ImdbScraper\Parser\IntegerValidator;

class RecommendationParser extends AbstractArrayParser
{
    use IntegerValidator;

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '|data-tconst=\"tt([0-9]{7})\"|U';
    }
}
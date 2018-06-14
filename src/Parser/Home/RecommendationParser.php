<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 14/06/2018
 * Time: 22:30
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\IntegerValidator;

class RecommendationParser extends AbstractArrayParser
{
    use IntegerValidator;

    /** @var string */
    protected const PATTERN = '|data-tconst=\"tt([0-9]{7})\"|U';
}
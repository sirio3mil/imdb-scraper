<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 15:34
 */

namespace ImdbScraper\Parser;


class AbstractFloatParser extends AbstractValueParser
{
    use FloatValidator;
}
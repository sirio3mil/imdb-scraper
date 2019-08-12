<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 16:43
 */

namespace ImdbScraper\Parser;

abstract class AbstractStringParser extends AbstractValueParser
{
    use StringValidator;
}

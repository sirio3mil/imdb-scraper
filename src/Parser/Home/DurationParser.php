<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 14/06/2018
 * Time: 17:01
 */

namespace ImdbScraper\Parser\Home;


use ImdbScraper\Parser\AbstractIntegerParser;

class DurationParser extends AbstractIntegerParser
{

    /**
     * @return string
     */
    function getPattern(): string
    {
        return '|datetime=\"PT([0-9]{1,3})M\"|U';
    }
}
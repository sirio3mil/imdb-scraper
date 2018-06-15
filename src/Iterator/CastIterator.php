<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 31/05/2018
 * Time: 13:29
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\CastPeople;

class CastIterator extends AbstractRegexIterator
{
    public function __construct(CastPeople $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new CastPeople();
        }
        parent::__construct($regexModel);
    }
}
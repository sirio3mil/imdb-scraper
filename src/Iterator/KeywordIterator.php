<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 12:24
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\Keyword;

class KeywordIterator extends AbstractRegexIterator
{

    public function __construct(Keyword $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new Keyword();
        }
        parent::__construct($regexModel);
    }
}
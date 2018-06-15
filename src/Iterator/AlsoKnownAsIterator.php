<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 12:43
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\AlsoKnownAs;

class AlsoKnownAsIterator extends AbstractRegexIterator
{
    public function __construct(AlsoKnownAs $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new AlsoKnownAs();
        }
        parent::__construct($regexModel);
    }
}
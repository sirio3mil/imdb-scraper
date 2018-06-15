<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 31/05/2018
 * Time: 13:18
 */

namespace ImdbScraper\Iterator;

use ImdbScraper\Model\People;

class PersonIterator extends AbstractRegexIterator
{

    public function __construct(People $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new People();
        }
        parent::__construct($regexModel);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 9:54
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\Release;

class ReleaseIterator extends AbstractRegexIterator
{
    public function __construct(Release $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new Release();
        }
        parent::__construct($regexModel);
    }
}
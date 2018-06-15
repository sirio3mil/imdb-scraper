<?php
/**
 * Created by PhpStorm.
 * User: sirio
 * Date: 07/06/2018
 * Time: 22:31
 */

namespace ImdbScraper\Iterator;


use ImdbScraper\Model\Episode;

class EpisodeIterator extends AbstractRegexIterator
{
    public function __construct(Episode $regexModel = null)
    {
        if (!$regexModel) {
            $regexModel = new Episode();
        }
        parent::__construct($regexModel);
    }
}
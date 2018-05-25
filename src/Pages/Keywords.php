<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 17:02
 */

namespace ImdbScraper\Pages;


class Keywords extends Page
{

    protected const KEYWORD_PATTERN = '|/keyword/([^>]+)\?|U';

    public function __construct()
    {
        $this->setFolder('keywords');
    }

    public function getKeywords(): array
    {
        $matches = [];
        if (strpos($this->content, "Plot Keywords:") !== false) {
            $html = file_get_contents();
            if (!empty($html)) {
                preg_match_all(static::KEYWORD_PATTERN, $html, $matches);
            }
        }
        return $matches;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 31/05/2018
 * Time: 13:29
 */

namespace ImdbScraper\Model;


class CastPeopleList extends PeopleList
{
    public function __construct()
    {
        parent::__construct();
        $this->className = 'CastPeople';
    }
}
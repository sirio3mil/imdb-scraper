<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:07
 */

namespace ImdbScraper\Mapper;

use ImdbScraper\Iterator\CastPeopleIterator;
use ImdbScraper\Iterator\PeopleIterator;

class CastMapper extends AbstractPageMapper
{

    protected const DIRECTOR_PATTERN = '|<a href="/name/nm([^>]+)/?ref_=ttfc_fc_dr([0-9]+)">([^>]+)</a>|U';
    protected const WRITERS_PATTERN = '|<a href="/name/nm([^>]+)/?ref_=ttfc_fc_wr([0-9]+)">([^>]+)</a>|U';
    protected const CAST_PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"itemprop=\'url\'><span class=\"itemprop\" itemprop=\"name\">([^>]+)</span></a></td><td class=\"ellipsis\">(.*)</td><td class=\"character\">(.*)</td>|U';

    public function __construct()
    {
        $this->setFolder('fullcredits');
    }

    /**
     * @return PeopleIterator
     */
    public function getDirectors(): PeopleIterator
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::DIRECTOR_PATTERN, $this->content, $matches);
        }
        return (new PeopleIterator())->appendAll($matches);
    }

    /**
     * @return PeopleIterator
     */
    public function getWriters(): PeopleIterator
    {
        $matches = [];
        if (!empty($this->content)) {
            preg_match_all(static::WRITERS_PATTERN, $this->content, $matches);
        }
        return (new PeopleIterator())->appendAll($matches);
    }

    /**
     * @return CastPeopleIterator
     */
    public function getCast(): CastPeopleIterator
    {
        $matches = [];
        preg_match_all(static::CAST_PATTERN, $this->getContent(), $matches);
        return (new CastPeopleIterator())->appendAll($matches);
    }
}
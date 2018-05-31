<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:07
 */

namespace ImdbScraper\Pages;


use ImdbScraper\Model\CastPeople;
use ImdbScraper\Model\CastPeopleList;
use ImdbScraper\Model\People;
use ImdbScraper\Model\PeopleList;

class Credits extends Page
{

    protected const CREDITS_PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"> ([^>]+)</a>|U';
    protected const CAST_PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"itemprop=\'url\'><span class=\"itemprop\" itemprop=\"name\">([^>]+)</span></a></td><td class=\"ellipsis\">(.*)</td><td class=\"character\">(.*)</td>|U';

    protected $directorsContent;

    protected $writersContent;

    public function __construct()
    {
        $this->setFolder('fullcredits');
    }

    public function setContent(?string $content): Page
    {
        parent::setContent($content);

        if (strpos($this->content, "Directed by") !== false) {
            $arrayTemp = explode("Directed by", $this->content);
            $arrayTemp = explode("</table>", $arrayTemp[1]);
            if (!empty($arrayTemp[0])) {
                $this->setDirectorsContent($arrayTemp[0]);
            }
        }
        if (strpos($this->content, "Writing Credits") !== false) {
            $arrayTemp = explode("Writing Credits", $this->content);
            $arrayTemp = explode("</table>", $arrayTemp[1]);
            if (!empty($arrayTemp[0])) {
                $this->setWritersContent($arrayTemp[0]);
            }
        }

        return $this;
    }

    /**
     * @return PeopleList
     */
    public function getDirectors(): PeopleList
    {
        $matches = [];

        if (!empty($this->directorsContent)) {
            preg_match_all(static::CREDITS_PATTERN, $this->getDirectorsContent(), $matches);
        }

        return $this->getUniquePeople($matches);
    }

    /**
     * @return string
     */
    public function getDirectorsContent(): ?string
    {
        return $this->directorsContent;
    }

    /**
     * @param string $directorsContent
     * @return Credits
     */
    public function setDirectorsContent(string $directorsContent): Credits
    {
        $this->directorsContent = $directorsContent;
        return $this;
    }

    /**
     * @param array $matches
     * @return PeopleList
     */
    protected function getUniquePeople(array $matches): PeopleList
    {
        return (new PeopleList())->appendAll($matches);
    }

    /**
     * @return PeopleList
     */
    public function getWriters(): PeopleList
    {
        $matches = [];
        if (!empty($this->writersContent)) {
            preg_match_all(static::CREDITS_PATTERN, $this->getWritersContent(), $matches);
        }
        return $this->getUniquePeople($matches);
    }

    /**
     * @return string
     */
    public function getWritersContent(): ?string
    {
        return $this->writersContent;
    }

    /**
     * @param string $writersContent
     * @return Credits
     */
    public function setWritersContent(string $writersContent): Credits
    {
        $this->writersContent = $writersContent;
        return $this;
    }

    /**
     * @return CastPeopleList
     */
    public function getCast(): CastPeopleList
    {
        $matches = [];
        preg_match_all(static::CAST_PATTERN, $this->getContent(), $matches);
        return $this->getUniqueCastPeople($matches);
    }

    /**
     * @param array $matches
     * @return CastPeopleList
     */
    protected function getUniqueCastPeople(array $matches): CastPeopleList
    {
        return (new CastPeopleList())->appendAll($matches);
    }

}
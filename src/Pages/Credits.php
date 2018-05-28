<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 15:07
 */

namespace ImdbScraper\Pages;


use ImdbScraper\Model\People;

class Credits extends Page
{

    protected const CREDITS_PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"> ([^>]+)</a>|U';
    protected const CAST_PATTERN = '|<a href=\"/name/nm([^>]+)/([^>]+)\"itemprop=\'url\'><span class=\"itemprop\" itemprop=\"name\">([^>]+)</span></a></td><td class=\"ellipsis\">(.*)</td><td class=\"character\"><div>(.*)</div>|U';

    protected $directorsContent;

    protected $writersContent;

    public function __construct()
    {
        $this->setFolder('fullcredits');
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
     * @param string $writersContent
     * @return Credits
     */
    public function setWritersContent(string $writersContent): Credits
    {
        $this->writersContent = $writersContent;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectorsContent(): ?string
    {
        return $this->directorsContent;
    }

    /**
     * @return string
     */
    public function getWritersContent(): ?string
    {
        return $this->writersContent;
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
     * @param array $matches
     * @return People[]
     */
    protected function getUniquePeople(array $matches): array
    {
        /** @var People[] $peoples */
        $peoples = [];
        $ids = [];
        if ($matches && !empty($matches[0])) {
            $keys = count($matches[0]);
            for ($i = 0; $i < $keys; ++$i) {
                $imdbNumber = intval($matches[1][$i]);
                if ($imdbNumber && !in_array($imdbNumber, $ids)) {
                    $peoples[] = (new People())->setFullName($matches[3][$i])->setImdbNumber($imdbNumber);
                    $ids[] = $imdbNumber;
                }
            }
        }
        return $peoples;
    }

    /**
     * @return People[]
     */
    public function getDirectors(): array
    {
        $matches = [];

        if (!empty($this->directorsContent)) {
            preg_match_all(static::CREDITS_PATTERN, $this->getDirectorsContent(), $matches);
        }

        return $this->getUniquePeople($matches);
    }

    public function getWriters()
    {
        $matches = [];
        if (!empty($this->writersContent)) {
            preg_match_all(static::CREDITS_PATTERN, $this->getWritersContent(), $matches);
        }
        return $this->getUniquePeople($matches);
    }

    public function getCast()
    {
        $matches = [];
        preg_match_all(static::CAST_PATTERN, $this->getContent(), $matches);
        return $matches;
    }

}
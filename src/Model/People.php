<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 28/05/2018
 * Time: 15:20
 */

namespace ImdbScraper\Model;


class People
{

    protected $fullName;

    protected $imdbNumber;

    /**
     * @param string $fullName
     * @return People
     */
    public function setFullName(string $fullName): People
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @param int $imdbNumber
     * @return People
     */
    public function setImdbNumber(int $imdbNumber): People
    {
        $this->imdbNumber = $imdbNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @return int
     */
    public function getImdbNumber(): ?int
    {
        return $this->imdbNumber;
    }

}
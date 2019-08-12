<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 12:55
 */

namespace ImdbScraper\Model;

use function preg_match_all;
use function intval;

trait VoteParser
{

    /** @var int */
    protected $relevantVotes;

    /** @var int */
    protected $totalVotes;

    /**
     * @return int
     */
    public function getRelevantVotes(): int
    {
        return $this->relevantVotes ?? 0;
    }

    /**
     * @param int $relevantVotes
     * @return self
     */
    public function setRelevantVotes(int $relevantVotes): self
    {
        $this->relevantVotes = $relevantVotes;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalVotes(): int
    {
        return $this->totalVotes ?? 0;
    }

    /**
     * @param int $totalVotes
     * @return self
     */
    public function setTotalVotes(int $totalVotes): self
    {
        $this->totalVotes = $totalVotes;

        return $this;
    }

    /**
     * @param string $rawData
     * @return self
     */
    protected function parseVotes(string $rawData): self
    {
        $matches = [];
        preg_match_all($this->getVotesPattern(), $rawData, $matches);
        if (!empty($matches[0])) {
            $this->setRelevantVotes(intval($matches[1][0]));
            $this->setTotalVotes(intval($matches[2][0]));
        }

        return $this;
    }

    /**
     * @return string
     */
    abstract public function getVotesPattern(): string;

}

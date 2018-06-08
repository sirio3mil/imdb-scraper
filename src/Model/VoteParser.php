<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 08/06/2018
 * Time: 12:55
 */

namespace ImdbScraper\Model;


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
        return $this->relevantVotes;
    }

    /**
     * @param int $relevantVotes
     * @return RegexMatchRawData
     */
    public function setRelevantVotes(int $relevantVotes): RegexMatchRawData
    {
        $this->relevantVotes = $relevantVotes;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalVotes(): int
    {
        return $this->totalVotes;
    }

    /**
     * @param int $totalVotes
     * @return RegexMatchRawData
     */
    public function setTotalVotes(int $totalVotes): RegexMatchRawData
    {
        $this->totalVotes = $totalVotes;
        return $this;
    }

    /**
     * @param string $rawData
     * @return RegexMatchRawData
     */
    protected function parseVotes(string $rawData): RegexMatchRawData
    {
        $matches = [];
        preg_match_all(static::VOTES_PATTERN, $rawData, $matches);
        if (!empty($matches[0])) {
            $this->setRelevantVotes(intval($matches[1][0]));
            $this->setTotalVotes(intval($matches[2][0]));
        }
        return $this;
    }
}
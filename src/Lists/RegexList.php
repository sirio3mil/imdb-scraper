<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 9:52
 */

namespace ImdbScraper\Lists;


abstract class RegexList extends \ArrayObject
{
    /** @var string */
    protected $className;

    /**
     * @param array $matches
     * @return RegexList
     */
    public function appendAll(array $matches): RegexList
    {
        if ($matches && !empty($matches[0])) {
            $keys = count($matches[0]);
            for ($i = 0; $i < $keys; ++$i) {
                $this->append((new $this->className())->importData($matches, $i));
            }
        }
        return $this;
    }
}
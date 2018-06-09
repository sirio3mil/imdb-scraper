<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 01/06/2018
 * Time: 9:52
 */

namespace ImdbScraper\Iterator;


abstract class AbstractRegexIterator extends \ArrayObject
{
    /** @var string */
    protected $modelClassName;

    /**
     * @param array $matches
     * @return AbstractRegexIterator
     */
    public function appendAll(array $matches): AbstractRegexIterator
    {
        if ($matches && !empty($matches[0])) {
            $keys = count($matches[0]);
            for ($i = 0; $i < $keys; ++$i) {
                $this->append((new $this->modelClassName())->importData($matches, $i));
            }
        }
        return $this;
    }
}
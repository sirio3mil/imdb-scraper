<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 31/05/2018
 * Time: 13:18
 */

namespace ImdbScraper\Model;

class PeopleList extends \ArrayObject
{

    protected $className;

    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        $this->className = 'ImdbScraper\Model\People';
    }

    /**
     * @param array $matches
     * @return PeopleList
     */
    public function appendAll(array $matches): PeopleList
    {
        $ids = [];
        if ($matches && !empty($matches[0])) {
            $keys = count($matches[0]);
            for ($i = 0; $i < $keys; ++$i) {
                $imdbNumber = intval($matches[1][$i]);
                if ($imdbNumber && !in_array($imdbNumber, $ids)) {
                    $this->append((new $this->className())->importData($matches, $i));
                    $ids[] = $imdbNumber;
                }
            }
        }
        return $this;
    }
}
<?php
/**
 * Authority: A simple and flexible authorization system for PHP.
 *
 * @package Authority
 */
namespace Authority;

use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

/**
 * Collection creates a lightweight reusable collection skeleton
 *
 * @package Authority
 */
class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /**
     * @var array Internal array for the elements in the collection
     */
    protected $items = [];

    /**
     * Collection constructor
     *
     * @param array $items Initial list of items for the collection
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * Push a new item onto the collection
     *
     * @return void
     */
    public function push($item)
    {
        $this->items[] = $item;
    }

    /**
     * Filter collection into another collection
     *
     * @return Collection
     */
    public function filter(callable $callback)
    {
        $items = array_filter($this->items, $callback);
        return new static($items);
    }

    /**
     * Find current number of items in collection
     *
     * @return integer
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Return array of items
     *
     * @return integer
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * Determine if collection is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}

<?php

namespace Admin\Miscellaneous;

use Exception;

class Collector
{

    /**
     * Child array on which to perform actions.
     *
     * @var array
     */
    protected $array = [];

    /**
     * Collector constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = null)
    {
        $this->array = $array ?? [];

        foreach ($this->array as $offset => $item) {
            if (is_array($item)) {
                $this->array[$offset] = new Collector($item);
            }
        }
    }

    /**
     * Gets a value from the collector, using a given key.
     *
     * @param int|string $offset the offset of the value to get.
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function get($offset)
    {
        if (!$this->has($offset)) {
            throw new Exception(sprintf('The value for offset %s could not be found.', $offset));
        }

        return $this->array[$offset];
    }

    /**
     * Checks if an offset exists in the collector.
     *
     * @param int|string $offset the offset to check for.
     *
     * @return bool
     */
    public function has($offset)
    {
        return array_key_exists($offset, $this->array);
    }

    /**
     * Sets the value of an offset in the array.
     *
     * @param mixed $offset the offset to set the value at.
     * @param mixed $value  the value to set at the offset.
     *
     * @return $this
     */
    public function set($offset, $value)
    {
        $this->array[$offset] = $value;

        return $this;
    }
}
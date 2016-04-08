<?php

namespace Admin\Read;

class Modifiers
{

    /**
     * Map of columns and their callable values.
     *
     * @var array
     */
    protected $map;

    /**
     * Adds a closure to a column name.
     *
     * @param array    $columns  the columns to apply to the map.
     * @param callable $callable the callable of the modifier.
     *
     * @return $this
     */
    public function add(array $columns, callable $callable)
    {
        foreach ($columns as $column) {
            $this->map[$column] = $callable;
        }

        return $this;
    }
}

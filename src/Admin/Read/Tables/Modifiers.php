<?php

namespace Admin\Read\Tables;

class Modifiers
{

    /**
     * Map over callbacks and their column names.
     *
     * @var array
     */
    public $map = [];

    /**
     * Adds a column and a callable resource to the map.
     *
     * @param string   $column
     * @param callable $callable
     *
     * @return $this
     */
    public function add(string $column, callable $callable)
    {
        $this->map[$column][] = $callable;

        return $this;
    }
}
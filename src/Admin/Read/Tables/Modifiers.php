<?php

namespace Admin\Read\Tables;

class Modifiers
{

    /**
     * Map over callbacks and their column names.
     *
     * @var array
     */
    protected $map = [];

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

    /**
     * Gets the map of modifiers and their columns.
     *
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }
}
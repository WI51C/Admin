<?php

namespace Admin\Read\Column;

class ColumnCollector
{

    /**
     * The defined columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Adds a column to the collector.
     *
     * @param string $name     the name of the column.
     * @param string $alias    the alias of the column.
     * @param int    $position the position of the column.
     */
    public function addColumn(string $name, string $alias, int $position = 1)
    {
        $this->columns[$name] = new Column($name, $alias, $position);
    }

    /**
     * Adds a custom column to the collector.
     *
     *
     */
    public function addCustom()
    {

    }
}
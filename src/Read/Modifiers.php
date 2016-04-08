<?php

namespace Admin\Read;

class Modifiers
{

    /**
     * Map of modifiers and their columns.
     *
     * @var array
     */
    protected $uses = [];

    /**
     * Applies a modifier to a column.
     *
     * @param array    $columns
     * @param callable $callable
     *
     * The callable will be passed two values:
     * - The column
     * - The row
     *
     * @return $this
     */
    public function apply(array $columns, callable $callable)
    {
        foreach ($columns as $column) {
            $this->uses[$column][] = $callable;
        }

        return $this;
    }
}

<?php

namespace Admin\Read\Tables;

class Presenter
{

    /**
     * Caption of the html table.
     *
     * @var string
     */
    public $caption;

    /**
     * Columns of the table.
     *
     * @var array
     */
    public $columns = [];

    /**
     * Sets the caption of the table.
     *
     * @param string $caption
     *
     * @return $this
     */
    public function caption(string $caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Sets the columns property of the object.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        foreach ($columns as $column => $alias) {
            $this->columns[is_int($column) ? $alias : $column] = $alias;
        }

        return $this;
    }

    /**
     * Inserts a new column and optionally an alias.
     *
     * @param string      $column
     * @param string|null $alias
     *
     * @return $this
     */
    public function addColumn(string $column, string $alias = null)
    {
        $this->columns[$column] = $alias ?? $column;

        return $this;
    }
}

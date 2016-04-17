<?php

namespace Admin\Read\Column;

use Admin\Read\Tables\Table;

class ColumnCollector
{

    /**
     * The table instance.
     *
     * @var Table
     */
    protected $table;

    /**
     * The defined columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * ColumnCollector constructor.
     *
     * @param Table $table table instance.
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Sets the columns of the table.
     *
     * @param array $column         the array using the structure:
     *                              [
     *                              'column' => 'header',
     *                              'column' => 'header',
     *                              ...
     *                              ]
     *
     * @return $this
     */
    public function set(array $column)
    {
        $this->columns = [];
        foreach ($column as $column => $header) {
            $this->add(is_int($column) ? $header : $column, $header);
        }

        return $this;
    }

    /**
     * Adds a column to the collector.
     *
     * @param string $column   the name of the column.
     * @param string $header   the header of the column.
     * @param int    $position the position of the column.
     *
     * @return Column
     */
    public function add(string $column, string $header, int $position = 100)
    {
        if (strpos($column, '.') === false) {
            $column = $this->table->table . '.' . $column;
        }

        $column          = new Column($column, $header, $position);
        $this->columns[] = $column;

        return $column;
    }

    /**
     * Gets all the columns to display in the table.
     *
     * @return $this
     */
    public function all()
    {
        $resolver      = new ColumnResolver($this->table);
        $this->columns = $resolver->resolve();

        return $this;
    }

    /**
     * Sorts the columns using their positions.
     *
     * @return $this
     */
    public function sort()
    {
        usort($this->columns, function (Column $a, Column $b) {
            return $a->position - $b->position;
        });

        return $this;
    }

    /**
     * Gets the table instance of the ColumnCollector.
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets the table instance of the ColumnCollector.
     *
     * @param Table $table the table to set.
     *
     * @return $this
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Gets the array of columns of the instance.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Sets the array of columns of the instance.
     *
     * @param array $columns the array of columns to set.
     *
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }
}

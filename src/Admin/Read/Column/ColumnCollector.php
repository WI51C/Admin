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
     * Automatically resolves the columns to display in the table.
     *
     * @return $this
     */
    public function all()
    {
        $resolver      = new ColumnResolver($this->table);
        $this->columns = $resolver->resolve();

        return $this->table;
    }

    /**
     * Sets the columns of the table as an array.
     *
     * @param array $columns        the columns to set. The array should be structured like so:
     *                              [
     *                              'column' => 'alias',
     *                              'column' => 'alias',
     *                              'column' => 'alias',
     *                              ];
     *
     *
     *
     * @return $this
     */
    public function set(array $columns)
    {
        $this->columns = [];
        foreach ($columns as $column => $alias) {
            $this->columns[] = new Column(is_int($column) ? $alias : $column, $alias, 100);
        }

        return $this;
    }

    /**
     * Adds a column to the collector.
     *
     * @param string $name     the name of the column.
     * @param string $header   the header of the column.
     * @param int    $position the position of the column.
     *
     * @return Column
     */
    public function add(string $name, string $header, int $position = 100)
    {
        $column          = new Column($name, $header, $position);
        $this->columns[] = $column;

        return $column;
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
    public function setTable($table)
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

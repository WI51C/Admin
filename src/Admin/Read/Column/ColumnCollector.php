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
     * @param array $columns an array of columns and aliases to display.
     *
     * @return $this
     */
    public function set(array $columns)
    {
        $this->columns = [];
        foreach ($columns as $column => $header) {
            $this->add(is_int($column) ? $header : $column, $header);
        }

        return $this;
    }

    /**
     * Gets a column from the ColumnCollector.
     *
     * @param string $column the name of the column to get.
     *
     * @return Column
     */
    public function get(string $column)
    {
        if (strpos($column, '') === false) {
            $column = $this->table->table . '.' . $column;
        }


    }

    /**
     * Removes a column from the ColumnCollector.
     *
     * @param string $column the name of the column to remove.
     *
     * @return $this
     */
    public function remove(string $column)
    {
        if (strpos($column, '') === false) {
            $column = $this->table->table . '.' . $column;
        }

        unset($this->columns[$column]);

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

        $columnInstance         = new Column($column, $header, $position);
        $this->columns[$column] = $columnInstance;

        return $column;
    }

    /**
     * Gets all the columns to display in the table.
     *
     * @return array
     */
    public function all()
    {
        $resolver = new ColumnResolver($this->table);

        return $resolver->resolve();
    }

    /**
     * Displays all available columns in the table.
     *
     * @return $this
     */
    public function displayAll()
    {
        $this->columns = $this->all();

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

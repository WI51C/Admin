<?php

namespace Admin\Read\Column;

use Admin\Read\Tables\Table;
use InvalidArgumentException;

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
     * Sets the columns to show.
     *
     * @param array $columns the columns to show.
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setColumns(array $columns)
    {
        foreach ($columns as $position => $column) {
            if (count($column) < 3)
                throw new InvalidArgumentException(sprintf('Array given to setColumns.'));
            $this->columns[$column[0]] = new StandardColumn($column[0], $column[1], $position);
        }

        return $this;
    }

    /**
     * Adds a column to the collector.
     *
     * @param string $name     the name of the column.
     * @param string $alias    the alias of the column.
     * @param int    $position the position of the column.
     *
     * @return $this
     */
    public function addColumn(string $name, string $alias, int $position = 100)
    {
        $this->columns[$name] = new StandardColumn($name, $alias, $position);

        return $this;
    }

    /**
     * Adds a custom column to the collector.
     *
     * @param string   $name     the name of the column.
     * @param string   $alias    the alias of the column.
     * @param int      $position the position of the column.
     * @param callable $callable the callable that create the content of the column.
     *
     * @return $this
     */
    public function addCustom(string $name, string $alias, int $position = 100, callable $callable)
    {
        $this->columns[$name] = new CustomColumn($name, $alias, $position, $callable);

        return $this;
    }

    /**
     * Automatically resolves the columns to select from the table.
     *
     * @return $this
     */
    public function autoResolve()
    {
        $resolver = new ColumnResolver($this->table);
        $resolver->select();
        $resolver->sort();

        return $resolver->return();
    }

    /**
     * Gets the columns
     *
     * @return array
     */
    public function getColumns()
    {
        if (empty($this->columns)) {
            $this->columns = $this->autoResolve();
        }

        return $this->columns;
    }

    /**
     * Sorts the columns using their positions.
     *
     * @return $this
     */
    public function sort()
    {
        usort($this->columns, function (Column $a, Column $b) {
            return $a->getPosition() - $b->getPosition();
        });

        return $this;
    }
}

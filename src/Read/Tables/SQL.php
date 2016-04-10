<?php

namespace Admin\Read\Tables;

use Admin\Read\Relations\RelationCollector;

class SQL
{

    /**
     * The table of the table.
     *
     * @var string
     */
    public $table = '';

    /**
     * Limit of the table.
     *
     * @var null|int
     */
    public $limit = 2147483647;

    /**
     * Offset of the table.
     *
     * @var int
     */
    public $offset = 0;

    /**
     * Where statements of the table.
     *
     * @var array
     */
    public $wheres = [];

    /**
     * Having statements of the table.
     *
     * @var array
     */
    public $havings = [];

    /**
     * Order by clauses of the table.
     *
     * @var array
     */
    public $orders = [];

    /**
     * Group by clauses.
     *
     * @var array
     */
    public $group = null;

    /**
     * The inline tables of the Table.
     *
     * @var RelationCollector
     */
    public $relations;

    /**
     * SQL constructor.
     */
    public function __construct()
    {
        $this->relations = new RelationCollector();
    }

    /**
     * Sets the table of the HTML table.
     *
     * @param string $table
     *
     * @throws Exception if the table doesnt exist.
     *
     * @return $this
     */
    public function table(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Sets the limit of the table.
     *
     * @param int $limit
     *
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Sets the offset of the table.
     *
     * @param int $offset
     *
     * @return $this
     */
    public function offset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Defines a where clause of the table.
     *
     * @param string $column
     * @param mixed  $value
     * @param string $operator
     * @param string $condition
     *
     * @return $this
     */
    public function where(string $column, $value, $operator = '=', $condition = 'AND')
    {
        $this->wheres[] = [
            $column,
            $value,
            $operator,
            $condition,
        ];

        return $this;
    }

    /**
     * Defines a having clause of the table.
     *
     * @param string $column
     * @param mixed  $value
     * @param string $operator
     * @param string $condition
     *
     * @return $this
     */
    public function having(string $column, $value, $operator = '=', $condition = 'AND')
    {
        $this->havings[] = [
            $column,
            $value,
            $operator,
            $condition,
        ];

        return $this;
    }

    /**
     * Adds an ORDER BY clause to the table.
     *
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function order(string $column, $direction = 'DESC')
    {
        $this->orders[] = [
            $column,
            $direction,
        ];

        return $this;
    }

    /**
     * Sets the column to group by.
     *
     * @param string $column
     *
     * @return $this
     */
    public function group(string $column)
    {
        $this->group = $column;

        return $this;
    }
}

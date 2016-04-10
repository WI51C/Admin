<?php

namespace Admin\Read;

use Admin\Crud;
use Exception;

class Table
{

    /**
     * Instance of CRUD.
     *
     * @var Crud
     */
    protected $crud;

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
     * Columns of the table.
     *
     * @var array
     */
    public $columns = [];

    /**
     * The inline tables of the Table.
     *
     * @var RelationCollector
     */
    public $relations;

    /**
     * Table constructor.
     *
     * @param Crud $crud
     */
    public function __construct(Crud $crud)
    {
        $this->crud      = $crud;
        $this->relations = new RelationCollector($this->crud, $this);
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

    /**
     * Sets the columns property of the object.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Gets primary table data, and One-To-One relational data.
     *
     * @return array
     */
    public function getData()
    {
        $query = clone $this->crud->connection;

        foreach ($this->relations->getOneToOneRelations() as $oto)
            $query->join($oto[0], $oto[1], $oto[2]);

        foreach ($this->orders as $order)
            $query->orderBy($order[0], $order[1]);

        foreach ($this->havings as $having)
            $query->having($having[0], $having[1], $having[2], $having[3]);

        foreach ($this->wheres as $where)
            $query->where($where[0], $where[1], $where[2], $where[3]);

        if ($this->group !== null)
            $query->orderBy($this->group);

        return $query->get($this->table, [$this->offset, $this->limit]);
    }
}

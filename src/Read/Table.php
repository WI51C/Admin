<?php

namespace Admin\Read;

use Admin\CRUD;
use Admin\Read\Renderer\TableRenderer;
use Exception;

class Table
{

    /**
     * Instance of CRUD.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * The table of the table.
     *
     * @var string
     */
    protected $table = '';

    /**
     * Limit of the table.
     *
     * @var null|int
     */
    protected $limit = 2147483647;

    /**
     * Offset of the table.
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * Where statements of the table.
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * Having statements of the table.
     *
     * @var array
     */
    protected $havings = [];

    /**
     * Order by clauses of the table.
     *
     * @var array
     */
    protected $orders = [];

    /**
     * Columns of the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The inline tables of the Table.
     *
     * @var RelationCollector
     */
    public $relations;

    /**
     * Table constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD      = $CRUD;
        $this->relations = new RelationCollector($this->CRUD, $this);
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
     * Renders the table.
     *
     * @return string
     */
    public function render()
    {
        $renderer = new TableRenderer();
        $renderer->setHeaders($this->getHeaders());
        $renderer->setData($this->getData());

        return $renderer->render();
    }

    /**
     * Gets the data of the table.
     *
     * Gets the data from the main table, and any One-To-One relations.
     *
     * @return array
     */
    public function getData()
    {
        $query = clone $this->CRUD->connection;

        foreach ($this->relations->getOneToOneRelations() as $oto) {
            $query->join($oto[0], $oto[1], $oto[2]);
        }

        foreach ($this->orders as $order) {
            $query->orderBy($order[0], $order[1]);
        }

        foreach ($this->havings as $having) {
            $query->having($having[0], $having[1], $having[2], $having[3]);
        }

        foreach ($this->wheres as $where) {
            $query->where($where[0], $where[1], $where[2], $where[3]);
        }

        $data    = $query->get($this->table, [$this->offset, $this->limit]);
        $columns = $this->getColumns();
        foreach ($data as $position => $row) {
            $data[$position] = array_filter($row, function ($column) use ($columns) {
                return in_array($column, $columns);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $data;
    }

    /**
     * Gets the column names to select.
     *
     * @return array
     */
    protected function getColumns()
    {
        $this->autoColumns();

        $return = [];
        foreach ($this->columns as $key => $value) {
            $return[] = is_int($key) ? $value : $key;
        }

        return $return;
    }

    /**
     * Gets the header names to display.
     *
     * @return array
     */
    protected function getHeaders()
    {
        $this->autoColumns();

        return array_values($this->columns);
    }

    /**
     * If no columns were specified, all will be found.
     */
    protected function autoColumns()
    {

        if (empty($this->columns)) {
            $query = clone $this->CRUD->connection;
            $query->where('table_schema', $this->CRUD->database);
            $tables = [$this->table];
            foreach ($this->relations->getOneToOneRelations() as $oto) {
                $tables[] = $oto[0];
            }

            $query->where('table_name', ['IN' => $tables]);
            $this->columns = array_map(function ($value) {
                return $value['column_name'];
            }, $query->get('information_schema.columns', null, ['column_name']));
        }
    }

    /**
     * Returns the name of the table.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
}

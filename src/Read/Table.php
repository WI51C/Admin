<?php

namespace Admin\Read;

use Admin\CRUD;
use Admin\Read\Inline\InlineTable;
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
     * The array of simple relations
     *
     * @var array
     */
    protected $oto = [];

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
    protected $limit = null;

    /**
     * Offset of the table.
     *
     * @var int
     */
    protected $offset;

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
     * The closures
     *
     * @var Modifiers
     */
    public $modifiers;

    /**
     * The inline tables of the Table.
     *
     * @var InlineTable
     */
    public $inline;

    /**
     * Table constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD      = $CRUD;
        $this->modifiers = new Modifiers();
        $this->inline    = new InlineCollector($this->CRUD);
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
        if (!$this->CRUD->connection->has($table)) {
            throw new Exception(sprintf('Table %s doesnt exist in database %s.', $table, $this->CRUD->database));
        }

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
     * Joins another table.
     *
     * @param string $table     the table to join on.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     *
     * @return $this
     */
    public function oto(string $table, string $condition, string $type = 'INNER')
    {
        $this->oto[] = [
            'table'     => $table,
            'condition' => $condition,
            'type'      => $type,
        ];

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
        $renderer->setHeaders(array_values($this->columns));
        $renderer->setData($this->getData());

        return $renderer->render();
    }

    /**
     * Gets the data of the table.
     *
     * @return array
     */
    protected function getData()
    {
        foreach ($this->oto as $oto) {
            $this->CRUD->connection->join($oto['table'], $oto['condition'], $oto['type']);
        }
    }
}

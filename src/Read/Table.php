<?php

namespace Admin\Read;

use Admin\CRUD;
use Closure;
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
     * @var null|Closure
     */
    protected $limitation = null;

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
     * Columns that contains html.
     *
     * @var array
     */
    protected $noescape = [];

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
     * Adds a column to the table.
     *
     * @param string      $column
     * @param string|null $alias
     *
     * @return $this
     */
    public function addColumn(string $column, string $alias = null)
    {
        $column        = $alias === null ? [$column] : [$alias => $column];
        $this->columns = array_merge($this->columns, $column);

        return $this;
    }

    /**
     * Sets the noescape property of the object.
     *
     * @param array $noescape
     *
     * @return $this
     */
    public function noescapes(array $noescape)
    {
        $this->noescape = $noescape;

        return $this;
    }

    /**
     * Adds a column to the noescape property of the object.
     *
     * @param string $column
     *
     * @return $this
     */
    public function addNoescape(string $column)
    {
        $this->noescape[] = $column;

        return $this;
    }

    /**
     * Limit of the table.
     *
     * @param Closure $closure
     *
     * @return $this
     */
    public function limitation(Closure $closure)
    {
        $this->limitation = $closure;

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
}

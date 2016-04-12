<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Read\Process\Extractor;
use Admin\Read\Process\Modifier;
use Admin\Read\Process\Renderer;
use Admin\Read\Relations\RelationBinder;

class Table
{

    /**
     * Name of table to select from.
     *
     * @var string
     */
    protected $table;

    /**
     * Instance of Connection.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * Attributes to add to the table.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Caption of the html table.
     *
     * @var string|null
     */
    protected $caption;

    /**
     * Columns of the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Setting to show the head of the table.
     *
     * @var bool
     */
    protected $head = true;

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
     * Group by clauses.
     *
     * @var array
     */
    protected $group = null;

    /**
     * The inline tables of the Table.
     *
     * @var RelationBinder
     */
    protected $relations;

    /**
     * Table constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection      = $connection;
        $this->relations = new TableRelations($this->connection, $this);
    }

    /**
     * Adds an attribute to the table.
     *
     * @param string $attribute
     * @param string $value
     *
     * @return $this
     */
    public function attribute(string $attribute, string $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

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

    /**
     * Sets whether or not to display the head of the table.
     *
     * @param bool $setting
     *
     * @return $this
     */
    public function head(bool $setting)
    {
        $this->head = $setting;

        return $this;
    }

    /**
     * Renders the table as HTML.
     *
     * @return string
     */
    public function render()
    {
        $data      = $this->getData();
        $extractor = new Extractor($this, $data);
        $data      = $extractor->extract();
        $modifier  = new Modifier($this, $data);
        $data      = $modifier->modify();
        $renderer  = new Renderer($this, $data);

        return $renderer->render();
    }

    /**
     * Gets the data of the table.
     *
     * @return array
     */
    public function getData()
    {
        $query = $this->connection->query();
        foreach ($this->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        if ($this->offset !== 0) {
            return $query->get($this->table, $this->limit);
        }

        return $query->get($this->table, [$this->offset, $this->limit]);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Gets the instance of Connection of the table.
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Gets the attributes of the table.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Gets the caption of the table.
     *
     * @return null|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Gets the columns to display in the table.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Gets the head setting of the table.
     *
     * @return boolean
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Gets the LIMIT clauses of the table.
     *
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Gets the OFFSET of the table.
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Gets the WHERE clauses of the table.
     *
     * @return array
     */
    public function getWheres()
    {
        return $this->wheres;
    }

    /**
     * Gets the HAVING clauses of the table.
     *
     * @return array
     */
    public function getHavings()
    {
        return $this->havings;
    }

    /**
     * Gets the ORDER BY clauses of the table.
     *
     * @return array
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Gets the GROUP BY clauses of the table.
     *
     * @return array
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Gets the relation of the table.
     *
     * @return RelationBinder
     */
    public function getRelations()
    {
        return $this->relations;
    }
}

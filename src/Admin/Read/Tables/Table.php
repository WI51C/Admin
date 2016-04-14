<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Read\AttributeCollector;
use Admin\Read\Column\Column;
use Admin\Read\Column\ColumnCollector;
use Admin\Read\Process\Extractor;
use Admin\Read\Process\Renderer;
use Admin\Read\Relations\OTO;
use Admin\Read\Relations\RelationCollector;

class Table extends AttributeCollector
{

    /**
     * Whether or not the table is inline or not.
     *
     * @var bool
     */
    protected $inline = false;

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
     * Caption of the html table.
     *
     * @var string|null
     */
    protected $caption;

    /**
     * Columns of the table.
     *
     * @var ColumnCollector
     */
    public $columns;

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
     * @var RelationCollector
     */
    public $relations;

    /**
     * Table constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->relations  = new RelationCollector($this);
        $this->columns    = new ColumnCollector($this);
    }

    /**
     * Renders the table as HTML.
     *
     * @return string
     */
    public function render()
    {
        $extractor = new Extractor($this);
        $data      = $extractor->getData();
        $columns   = $extractor->getColumns();
        $renderer  = new Renderer($this, $data, $columns);

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

        array_map(function (OTO $oto) use ($query) {
            $query->join($oto->getTable(), $oto->getCondition(), $oto->getType());
        }, $this->relations->getOneToOneRelations());

        $columns = array_map(function (Column $column) {
            return sprintf('%s "%s"', $column->name, $column->name);
        }, $this->columns->getColumns());

        return $query->get($this->table, [$this->offset, $this->limit], $columns);
    }

    /**
     * Sets the primary table.
     *
     * @param string $table the table to set.
     *
     * @return $this
     */
    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Sets the caption of the table.
     *
     * @param string $caption the caption to display above the table.
     *
     * @return $this
     */
    public function setCaption(string $caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Sets the columns property of the object.
     *
     * @param array $columns    the columns to add in the pattern:
     *                          [
     *                          'users.username',
     *                          'users.password' => 'alias',
     *                          ],
     *
     * @return $this
     */
    public function setColumns(array $columns)
    {
        foreach ($columns as $column => $alias) {
            $this->columns[is_int($column) ? $alias : $column] = $alias;
        }

        return $this;
    }

    /**
     * Inserts a new column and optionally an alias.
     *
     * @param string      $column the column to add.
     * @param string|null $alias  the header (alias) of the column in the table.
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
    public function showHead(bool $setting)
    {
        $this->head = $setting;

        return $this;
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
     * Gets the caption of the table.
     *
     * @return null|string
     */
    public function getCaption()
    {
        return $this->caption;
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
     * @return RelationCollector
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Returns whether or not the table is inline.
     *
     * @return bool
     */
    public function isInline()
    {
        return $this->inline;
    }
}

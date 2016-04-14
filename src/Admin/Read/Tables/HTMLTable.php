<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Database\RelationCollector;
use Admin\Database\Relations\OTO;
use Admin\Database\Table;
use Admin\Read\Column\Column;
use Admin\Read\Column\ColumnCollector;
use InvalidArgumentException;

class HtmlTable extends Table
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
     * Table constructor.
     */
    public function __construct()
    {
        $this->columns = new ColumnCollector($this);
    }

    /**
     * Renders the table as HTML.
     *
     * @return string
     */
    public function render()
    {
        return 'table';
    }

    /**
     * Gets the data of the table.
     *
     * @param Connection $connection the connection to use to get the data.
     *
     * @return array
     */
    public function getData(Connection $connection)
    {
        $query = $connection->query();
        array_map(function (OTO $oto) use ($query) {
            $query->join($oto->getTable(), $oto->getCondition(), $oto->getType());
        }, $this->relations->getOneToOneRelations());

        $columns = array_map(function (Column $column) {
            return sprintf('%s "%s"', $column->name, $column->name);
        }, $this->columns->getColumns());

        return $query->get($this->table, [$this->offset, $this->limit], $columns);
    }

    /**
     * Sets pagination of the table.
     *
     * @param int $page    the current page.
     * @param int $results the number of results to display.
     *
     * @throws InvalidArgumentException if the page number isn't positive.
     *
     * @return $this
     */
    public function pagination(int $page = 1, int $results)
    {
        if ($page < 1) {
            throw new InvalidArgumentException('Pagination page number must be positive. %d give.');
        }

        $this->offset = $results * $page - $results;
        $this->limit  = $results;

        return $this;
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

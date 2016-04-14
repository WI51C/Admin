<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Database\RelationCollector;
use Admin\Database\Table as DatabaseTable;
use Admin\Read\Column\ColumnCollector;
use InvalidArgumentException;

class Table extends DatabaseTable
{

    /**
     * Whether or not the table is inline or not.
     *
     * @var bool
     */
    protected $inline = false;

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
    protected $groups = [];

    /**
     * Table constructor.
     *
     * @param Connection $connection an instance of connection.
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);

        $this->columns = new ColumnCollector($this);
    }

    /**
     * Renders the table as HTML.
     *
     * @return string
     */
    public function render()
    {
        var_dump($this->getData());
    }

    /**
     * Gets the data of the table.
     *
     * @return array
     */
    public function getData()
    {
        $query   = $this->connection->query();
        $columns = [];

        foreach ($this->groups as $group) {
            $query->groupBy($group);
        }

        foreach ($this->wheres as $where) {
            $query->where($where[0], $where[1], $where[2], $where[3]);
        }

        foreach ($this->havings as $having) {
            $query->having($having[0], $having[1], $having[2], $having[3]);
        }

        foreach ($this->orders as $order) {
            $query->orderBy($order[0], $order[1], $order[2]);
        }

        foreach ($this->relations->oto as $relation) {
            $query->join($relation->table, $relation->condition, $relation->type);
        }

        foreach ($this->columns->getColumns() as $column) {
            $columns[] = sprintf('%s "%s"', $column->name, $column->name);
        }

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
    public function addPagination(int $page = 1, int $results)
    {
        if ($page < 1) {
            throw new InvalidArgumentException('Pagination page number must be positive. %d give.');
        }

        $this->offset = $results * $page - $results;
        $this->limit  = $results;

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
     * Gets the caption of the table.
     *
     * @return null|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Sets whether or not to display the head of the table.
     *
     * @param bool $setting
     *
     * @return $this
     */
    public function setHead(bool $setting)
    {
        $this->head = $setting;

        return $this;
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
     * Sets the limit of the table.
     *
     * @param int $limit the limit to set.
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
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
     * Sets the offset of the table.
     *
     * @param int $offset the offset to set.
     *
     * @return $this
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;

        return $this;
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
     * Adds a where clause to the table exclusion.
     *
     * @param string $whereProp  the property to exclude by.
     * @param string $whereValue the value to exclude by.
     * @param string $operator   the operator to use in the exclusion.
     * @param string $cond       the condition to link conditions together with.
     *
     * @return $this
     */
    public function addWhere(string $whereProp, string $whereValue = 'DBNULL', string $operator = '=', string $cond = 'AND')
    {
        $this->wheres[] = [
            $whereProp,
            $whereValue,
            $operator,
            $cond,
        ];

        return $this;
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
     * Adds a having clause to the table exclusion.
     *
     * @param string $havingProp  the property to exclude by.
     * @param string $havingValue the value to exclude by.
     * @param string $operator    the operator to use in the exclusion.
     * @param string $cond        the condition to link conditions together with.
     *
     * @return $this
     */
    public function addHaving(string $havingProp, string $havingValue = 'DBNULL', string $operator = '=', string $cond = 'AND')
    {
        $this->havings[] = [
            $havingProp,
            $havingValue,
            $operator,
            $cond,
        ];

        return $this;
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
     * Adds an ORDER BY clause to the query.
     *
     * @param string $orderByField     the property to oder by.
     * @param string $orderByDirection the direction.
     * @param array  $customFields     fieldset for ORDER BY FIELD() ordering.
     *
     * @return $this
     */
    public function addOrder(string $orderByField, string $orderByDirection = 'DESC', $customFields = null)
    {
        $this->orders[] = [
            $orderByField,
            $orderByDirection,
            $customFields,
        ];

        return $this;
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
     * Adds a GROUP BY clause to the query.
     *
     * @param string $groupByField the field to group by.
     *
     * @return $this
     */
    public function addGroup(string $groupByField)
    {
        $this->groups[] = $groupByField;

        return $this;
    }

    /**
     * Gets the GROUP BY clauses of the table.
     *
     * @return array
     */
    public function getGroup()
    {
        return $this->groups;
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

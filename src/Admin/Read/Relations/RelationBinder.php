<?php

namespace Admin\Read\Relations;

use Admin\Connection;
use Admin\Read\Tables\Table;
use Closure;
use Exception;

class RelationBinder
{

    /**
     * The instance of the RelationBinder.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * The table instance of the RelationBinder.
     *
     * @var Table
     */
    protected $parent;

    /**
     * The defined One-To-One relations of the collector.
     *
     * @var array
     */
    protected $oto = [];

    /**
     * The defined One-To-Many relations of the collector.
     *
     * @var array
     */
    protected $otm = [];

    /**
     * The defined Many-To-Many relations of the collector.
     *
     * @var array
     */
    protected $mtm = [];

    /**
     * RelationBinder constructor.
     *
     * @param Connection  $connection
     * @param Table $parent
     */
    public function __construct(Connection $connection, Table $parent)
    {
        $this->connection   = $connection;
        $this->parent = $parent;
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
        $this->oto[] = new OneOne($table, $condition, $type);

        return $this;
    }

    /**
     * Joins another table.
     *
     * @param string  $table        the table to join on, and its optional alias.
     * @param string  $parentColumn the foreign (parent) column to join on.
     * @param string  $childColumn  the local (child) column to join on.
     * @param Closure $closure      |null   a closure to change the relation.
     *
     * @throws Exception if the $table array was malformed
     *
     * @return $this
     */
    public function otm(string $table, string $parentColumn, string $childColumn, Closure $closure = null)
    {
        $relation    = new OneMany($this->connection, $table, $parentColumn, $childColumn);
        $this->otm[] = $relation;
        if ($closure !== null) {
            call_user_func($closure, $relation);
        }

        return $this;
    }

    /**
     * Creates a new Many-To-Many relation to the table.
     *
     * @param string       $table
     * @param string       $parentColumn
     * @param string       $childColumn
     * @param string       $middleTable
     * @param string       $middleJoinCondition
     * @param string       $middleJoinType
     * @param Closure|null $closure
     *
     * @return $this
     */
    public function mtm(
        string $table,
        string $parentColumn,
        string $childColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType = 'INNER',
        Closure $closure = null
    ) {
        $relation = new ManyMany(
            $this->connection,
            $table,
            $parentColumn,
            $childColumn,
            $middleTable,
            $middleJoinCondition,
            $middleJoinType
        );

        $this->mtm[] = $relation;
        if ($closure !== null) {
            call_user_func($closure, $relation);
        }

        return $this;
    }

    /**
     * Gets the One-To-One relations of the collector.
     *
     * @return array
     */
    public function getOneToOneRelations()
    {
        return $this->oto;
    }

    /**
     * Gets the One-To-Many relations of the collector.
     *
     * @return array
     */
    public function getOtmRelations()
    {
        return $this->otm;
    }

    /**
     * Gets the Many-To-Many relations of the collector.
     *
     * @return array
     */
    public function getMtmRelations()
    {
        return $this->mtm;
    }
}

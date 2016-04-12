<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Read\Relations\MTM;
use Admin\Read\Relations\OTM;
use Admin\Read\Relations\OTO;
use Exception;

class TableRelations
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
     * @param Connection $connection
     * @param Table      $parent
     */
    public function __construct(Connection $connection, Table $parent)
    {
        $this->connection = $connection;
        $this->parent     = $parent;
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
        $this->oto[] = new OTO($table, $condition, $type);

        return $this;
    }

    /**
     * Joins another table.
     *
     * @param string        $table        the table to join on, and its optional alias.
     * @param string        $parentColumn the foreign (parent) column to join on.
     * @param string        $childColumn  the local (child) column to join on.
     * @param callable|null $callable     a closure to change the relation.
     *
     * @throws Exception if the $table array was malformed
     *
     * @return $this
     */
    public function otm(string $table, string $parentColumn, string $childColumn, callable $callable = null)
    {
        $relation    = new OTM($this->connection, $table, $parentColumn, $childColumn);
        $this->otm[] = $relation;
        if ($callable !== null) {
            call_user_func($callable, $relation);
        }

        return $this;
    }

    /**
     * Creates a new Many-To-Many relation to the table.
     *
     * @param string        $table
     * @param string        $parentColumn
     * @param string        $childColumn
     * @param string        $middleTable
     * @param string        $middleJoinCondition
     * @param string        $middleJoinType
     * @param callable|null $callable
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
        callable $callable = null
    ) {
        $relation = new MTM(
            $this->connection,
            $table,
            $parentColumn,
            $childColumn,
            $middleTable,
            $middleJoinCondition,
            $middleJoinType
        );

        $this->mtm[] = $relation;
        if ($callable !== null) {
            call_user_func($callable, $relation);
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
    public function getOneToManyRelations()
    {
        return $this->otm;
    }

    /**
     * Gets the Many-To-Many relations of the collector.
     *
     * @return array
     */
    public function getManyToManyRelations()
    {
        return $this->mtm;
    }
}

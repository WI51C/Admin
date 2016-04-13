<?php

namespace Admin\Read\Relations;

use Admin\Connection;
use Admin\Read\Tables\Table;
use Exception;

class RelationCollector
{

    /**
     * The instance of the TableRelations.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * The table instance of the TableRelations.
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
     * TableRelations constructor.
     *
     * @param Table $parent the parent of the relations.
     */
    public function __construct(Table $parent)
    {
        $this->connection = $parent->getConnection();
        $this->parent     = $parent;
    }

    /**
     * Joins another table.
     *
     * @param string $table     the table to join on.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     *
     * @return OTO
     */
    public function newOTO(string $table, string $condition, string $type = 'INNER')
    {
        $this->oto[] = new OTO($table, $condition, $type);

        return $this;
    }

    /**
     * Joins another table.
     *
     * @param string $table        the table to join on, and its optional alias.
     * @param string $parentColumn the foreign (parent) column to join on.
     * @param string $childColumn  the local (child) column to join on.
     *
     * @throws Exception if the $table array was malformed
     *
     * @return Table
     */
    public function newOTM(string $table, string $parentColumn, string $childColumn)
    {
        $relation    = new OTM($this->connection, $table, $parentColumn, $childColumn);
        $this->otm[] = $relation;

        return $relation;
    }

    /**
     * Creates a new Many-To-Many relation to the table.
     *
     * @param string $table
     * @param string $parentColumn
     * @param string $childColumn
     * @param string $middleTable
     * @param string $middleJoinCondition
     * @param string $middleJoinType
     *
     * @return Table
     */
    public function newMTM(
        string $table,
        string $parentColumn,
        string $childColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType = 'INNER'
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

        return $relation;
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

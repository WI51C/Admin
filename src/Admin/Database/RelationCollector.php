<?php

namespace Admin\Database;

use Admin\Database\Relations\MTM;
use Admin\Database\Relations\OTM;
use Admin\Database\Relations\OTO;
use Admin\Read\Tables\Table as VisualTable;
use Admin\Read\Tables\TableDescendant;
use Exception;

class RelationCollector
{

    /**
     * The parent Table instance.
     *
     * @var VisualTable
     */
    protected $table;

    /**
     * The defined One-To-One relations of the collector.
     *
     * @var array
     */
    public $oto = [];

    /**
     * The defined One-To-Many relations of the collector.
     *
     * @var array
     */
    public $otm = [];

    /**
     * The defined Many-To-Many relations of the collector.
     *
     * @var array
     */
    public $mtm = [];

    /**
     * RelationCollector constructor.
     *
     * @param VisualTable $table the parent table.
     */
    public function __construct(VisualTable $table)
    {
        $this->table = $table;
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
        $relation    = new OTM($table, $parentColumn, $childColumn);
        $table       = new TableDescendant($this->table->getConnection(), $relation);
        $this->otm[] = $table;

        return $table;
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
            $table,
            $parentColumn,
            $childColumn,
            $middleTable,
            $middleJoinCondition,
            $middleJoinType
        );

        $table       = new TableDescendant($this->table->getConnection(), $relation);
        $this->mtm[] = $table;

        return $table;
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

<?php

namespace Admin\Database\Relations;

class MTM extends OTM
{

    /**
     * The middle table.
     *
     * @var string
     */
    public $middleJoinTable;

    /**
     * The condition to join the middle and primary table.
     *
     * @var string
     */
    public $middleJoinCondition;

    /**
     * The join type of the middle and primary table relation.
     *
     * @var string
     */
    public $middleJoinType;

    /**
     * MTM constructor.
     *
     * @param string $table               the table to (primary) display.
     * @param string $parentColumn        the parent column to join on.
     * @param string $childColumn         the child column to join on.
     * @param string $middleTable         the table to join the primary table on.
     * @param string $middleJoinCondition the condition to join the middle and primary table on.
     * @param string $middleJoinType      the type of join to perform between to middle and primary table.
     */
    public function __construct(
        string $table,
        string $parentColumn,
        string $childColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType = 'INNER'
    ) {
        parent::__construct($table, $parentColumn, $childColumn);

        $this->middleJoinTable     = $middleTable;
        $this->middleJoinType      = $middleJoinType;
        $this->middleJoinCondition = $middleJoinCondition;
    }

    /**
     * Gets the middle join table of the relation.
     *
     * @return string
     */
    public function getMiddleJoinTable()
    {
        return $this->middleJoinTable;
    }

    /**
     * Sets the middle join table of the relation.
     *
     * @param string $middleJoinTable the table name.
     *
     * @return MTM
     */
    public function setMiddleJoinTable(string $middleJoinTable)
    {
        $this->middleJoinTable = $middleJoinTable;

        return $this;
    }

    /**
     * Gets the middle join condition.
     *
     * @return string
     */
    public function getMiddleJoinCondition()
    {
        return $this->middleJoinCondition;
    }

    /**
     * Sets the middle join condition of the relation.
     *
     * @param string $middleJoinCondition the middle join condition.
     *
     * @return MTM
     */
    public function setMiddleJoinCondition(string $middleJoinCondition)
    {
        $this->middleJoinCondition = $middleJoinCondition;

        return $this;
    }

    /**
     * Gets the type of the middle table join.
     *
     * @return string
     */
    public function getMiddleJoinType()
    {
        return $this->middleJoinType;
    }

    /**
     * Sets the type of the middle join.
     *
     * @param string $middleJoinType the type of join to perform.
     *
     * @return MTM
     */
    public function setMiddleJoinType(string $middleJoinType)
    {
        $this->middleJoinType = $middleJoinType;

        return $this;
    }
}
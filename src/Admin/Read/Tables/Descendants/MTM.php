<?php

namespace Admin\Read\Tables\Descendants;

use Admin\Read\Tables\Table;

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
     * @param Table  $parent              the parent of the relation.
     * @param string $table               the table to (primary) display.
     * @param string $parentColumn        the parent column to join on.
     * @param string $descendantColumn    the child column to join on.
     * @param string $middleTable         the table to join the primary table on.
     * @param string $middleJoinCondition the condition to join the middle and primary table on.
     * @param string $middleJoinType      the type of join to perform between to middle and primary table.
     */
    public function __construct(
        Table $parent,
        string $table,
        string $parentColumn,
        string $descendantColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType
    ) {
        parent::__construct($parent, $table, $parentColumn, $descendantColumn);
        $this->middleJoinTable     = $middleTable;
        $this->middleJoinType      = $middleJoinType;
        $this->middleJoinCondition = $middleJoinCondition;

        $this->relations->addOto($middleTable, $middleJoinCondition, $middleJoinType);
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

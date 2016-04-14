<?php

namespace Admin\Database\Relations;

use Admin\Database\Relation;

class OTM extends Relation
{

    /**
     * The table to join on.
     *
     * @var string
     */
    public $table;

    /**
     * The parent columns name of the join.
     *
     * @var string
     */
    public $parentColumn;

    /**
     * Local column name of the join.
     *
     * @var
     */
    public $childColumn;

    /**
     * OTO constructor.
     *
     * @param string $table        the table to join on.
     * @param string $parentColumn the parent column to join with.
     * @param string $childColumn  the descendant column to join with.
     */
    public function __construct(string $table, string $parentColumn, string $childColumn)
    {
        $this->table        = $table;
        $this->parentColumn = $parentColumn;
        $this->childColumn  = $childColumn;
    }

    /**
     * Gets the table of the OTM.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets the table of the OTM.
     *
     * @param string $table the table name.
     *
     * @return OTM
     */
    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Gets the parentColumn of the OTM.
     *
     * @return string
     */
    public function getParentColumn()
    {
        return $this->parentColumn;
    }

    /**
     * Sets the parentColumn of the OTM.
     *
     * @param string $parentColumn
     *
     * @return $this
     */
    public function setParentColumn(string $parentColumn)
    {
        $this->parentColumn = $parentColumn;

        return $this;
    }

    /**
     * Gets the childColumn of the OTM.
     *
     * @return string
     */
    public function getChildColumn()
    {
        return $this->childColumn;
    }

    /**
     * Sets the childColumn property of the OTM.
     *
     * @param string $childColumn the column to set.
     *
     * @return $this
     */
    public function setChildColumn(string $childColumn)
    {
        $this->childColumn = $childColumn;

        return $this;
    }
}
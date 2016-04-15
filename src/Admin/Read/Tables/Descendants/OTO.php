<?php

namespace Admin\Read\Tables\Descendants;

use Admin\Read\Tables\Table;

class OTO
{

    /**
     * Parent of the relation.
     *
     * @var Table
     */
    public $parent;

    /**
     * The table of the join.
     *
     * @var string
     */
    public $table;

    /**
     * The parent column of the condition of the join.
     *
     * @var string
     */
    public $parentColumn;

    /**
     * The descendant column of the condition of the join.
     *
     * @var string
     */
    public $descendantColumn;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    public $type;

    /**
     * OTO constructor.
     *
     * @param Table  $parent           parent of the relation.
     * @param string $table            the of the table to relate to.
     * @param string $parentColumn     the parent column of the condition.
     * @param string $descendantColumn the descendant column of the condition.
     * @param string $type             the type of join to perform.
     */
    public function __construct(Table $parent, string $table, string $parentColumn, string $descendantColumn, string $type)
    {
        $this->parent           = $parent;
        $this->table            = $table;
        $this->parentColumn     = strtolower($parentColumn);
        $this->descendantColumn = strtolower($descendantColumn);
        $this->type             = $type;
    }

    /**
     * Gets the parent of the relation.
     *
     * @return Table
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent of the OTO relation.
     *
     * @param Table $parent the parent to set.
     *
     * @return $this
     */
    public function setParent(Table $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Gets the parent column of the condition.
     *
     * @return string
     */
    public function getParentColumn()
    {
        return $this->parentColumn;
    }

    /**
     * Sets the parent column of the condition.
     *
     * @param string $parentColumn the column.
     *
     * @return $this
     */
    public function setParentColumn(string $parentColumn)
    {
        $this->parentColumn = strtolower($$parentColumn);

        return $this;
    }

    /**
     * Gets the descendant column of the condition.
     *
     * @return string
     */
    public function getDescendantColumn()
    {
        return $this->descendantColumn;
    }

    /**
     * Sets the descendant column of the condition.
     *
     * @param string $descendantColumn the column.
     *
     * @return $this
     */
    public function setDescendantColumn(string $descendantColumn)
    {
        $this->descendantColumn = strtolower($$descendantColumn);

        return $this;
    }

    /**
     * Sets the type of join to perform.
     *
     * @param string $type the type of join to perform.
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the type of the join.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the table to join on.
     *
     * @param string $table the name of the table to join on.
     *
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Gets the table of the join.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
}

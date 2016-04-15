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
    public $condition;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    public $type;

    /**
     * OTO constructor.
     *
     * @param Table  $parent    parent of the relation.
     * @param string $table     the of the table to relate to.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     */
    public function __construct(Table $parent, string $table, string $condition, string $type)
    {
        $this->parent    = $parent;
        $this->table     = $table;
        $this->condition = strtolower($condition);
        $this->type      = $type;
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
     * Gets the condition of the OTO join.
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets the condition of the OTO join.
     *
     * @param string $condition the condition to set.
     *
     * @return $this
     */
    public function setCondition(string $condition)
    {
        $this->condition = $condition;

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

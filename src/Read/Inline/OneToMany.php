<?php

namespace Admin\Read\Inline;

use Admin\Crud;

class OneToMany extends TableRelation
{

    /**
     * The table to join on.
     *
     * @var string
     */
    protected $joinTable;

    /**
     * The condition to join on.
     *
     * @var string
     */
    protected $joinCondition;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    protected $joinType;

    /**
     * Alias of the Table, to be displayed in the inline-table.
     *
     * @var string
     */
    protected $alias;

    public function __construct(Crud $crud, string $joinTable, string $alias, string $joinCondition, string $joinType = 'INNER')
    {
        parent::__construct($crud);
        $this->table($joinTable);
        $this->alias($alias);
        $this->joinTable($joinTable);
        $this->joinCondition($joinCondition);
        $this->joinType($joinType);
    }

    /**
     * Sets the alias of the table.
     *
     * @param string $alias
     *
     * @return $this
     */
    public function alias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Sets the joinTable property of the object.
     *
     * @param string $table
     *
     * @return $this
     */
    public function joinTable(string $table)
    {
        $this->joinTable = $table;

        return $this;
    }

    /**
     * Sets the joinCondition property of the object.
     *
     * @param string $condition
     *
     * @return $this
     */
    public function joinCondition(string $condition)
    {
        $this->joinCondition = $condition;

        return $this;
    }

    /**
     * Sets the joinType property of the object.
     *
     * @param string $type
     *
     * @return $this
     */
    public function joinType(string $type)
    {
        $this->joinType = $type;

        return $this;
    }

    /**
     * Gets the primary table of the One-To-Many relation.
     *
     * @return string
     */
    public function getJoinTable()
    {
        return $this->joinTable;
    }

    /**
     * Gets the join condition of the One-To-Many relation.
     *
     * @return string
     */
    public function getJoinCondition()
    {
        return $this->joinCondition;
    }

    /**
     * Gets the join type of the One-To-Many relation.
     *
     * @return string
     */
    public function getJoinType()
    {
        return $this->joinType;
    }

    /**
     * Gets the alias of the table, or its name if no alias is defined.
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias === null ? $this->table : $this->alias;
    }
}

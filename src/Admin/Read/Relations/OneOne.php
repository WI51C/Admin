<?php

namespace Admin\Read\Relations;

class OneOne extends Relation
{

    /**
     * The table of the join.
     *
     * @var string
     */
    protected $table;

    /**
     * The condition of the join.
     *
     * @var string
     */
    protected $condition;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    protected $type;

    /**
     * OTO constructor.
     *
     * @param string $table
     * @param string $condition
     * @param string $type
     */
    public function __construct(string $table, string $condition, string $type = 'INNER')
    {
        $this->table     = $table;
        $this->condition = $condition;
        $this->type      = $type;
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

    /**
     * Gets the condition of the join.
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
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
}

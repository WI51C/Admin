<?php

namespace CRUDL\Relations\Instances;

use CRUDL\Relations\TabularRelation;

class OTMRelation extends TabularRelation
{

    /**
     * The table to join on.
     *
     * @var string
     */
    protected $joinTable;

    /**
     * The condition on which to join.
     *
     * @var string
     */
    protected $joinCondition;

    /**
     * The type of join to set.
     *
     * @var string
     */
    protected $joinType = 'INNER';

    /**
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
     * Sets the type of the join.
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
     * Sets the condition to join on the joinTable.
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
     * Gets the data of the tabular relation table.
     *
     * @return array
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
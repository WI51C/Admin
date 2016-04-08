<?php

namespace Admin\Read\TableRelations;

use Exception;

class MTMTableRelation extends TableRelation
{

    /**
     * The junction table of the ManyToMany table.
     *
     * @var string
     */
    protected $junction;

    /**
     * The condition to join on.
     *
     * @var string
     */
    protected $condition;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    protected $type = 'INNER';

    /**
     * Sets the junction of the ManyToMany table.
     *
     * @param string $table the table to set as the junction.
     *
     * @throws Exception if the table doesnt exist.
     *
     * @return $this
     */
    public function junction(string $table)
    {
        if (!$this->CRUD->has($table)) {
            throw new Exception(sprintf('The table %s could not be used as a junction.'));
        }

        $this->junction = $table;

        return $this;
    }

    /**
     * Sets the condition to join on.
     *
     * @param string $condition
     *
     * @return $this
     */
    public function condition(string $condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Sets the type of join to perform
     *
     * @param string $type
     *
     * @return $this
     */
    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }
}

<?php

namespace Admin\Read\Relations;

class OTO extends Relation
{

    /**
     * The table of the join.
     *
     * @var string
     */
    public $table;

    /**
     * The condition of the join.
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
}

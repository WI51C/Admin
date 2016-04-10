<?php

namespace Admin\Read\Relations;

use Admin\Read\Tables\Table;
use Admin\Crud;

class OTM extends Table
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
     * @param Crud   $crud
     * @param string $table
     * @param string $condition
     * @param string $type
     */
    public function __construct(Crud $crud, string $table, string $condition, string $type = 'INNER')
    {
        parent::__construct($crud);
        $this->table     = $table;
        $this->condition = $condition;
        $this->type      = $type;
    }
}

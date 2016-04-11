<?php

namespace Admin\Read\Relations;

use Admin\Crud;
use Admin\Read\Tables\Table;

class OTM extends Table
{

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
     * @param string $parentColumn
     * @param string $childColumn
     * @param string $type
     */
    public function __construct(Crud $crud, string $table, string $parentColumn, string $childColumn, string $type = 'INNER')
    {
        parent::__construct($crud);
        $this->sql->table   = $table;
        $this->type         = $type;
        $this->parentColumn = $parentColumn;
        $this->childColumn  = $childColumn;
    }
}

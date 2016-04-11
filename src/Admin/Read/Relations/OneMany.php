<?php

namespace Admin\Read\Relations;

use Admin\Crud;
use Admin\Read\Tables\Table;

class OneMany extends Table
{

    /**
     * The alias of the table.
     *
     * @var string
     */
    public $alias;

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
     * OneOne constructor.
     *
     * @param Crud   $crud
     * @param string $table
     * @param string $parentColumn
     * @param string $childColumn
     */
    public function __construct(Crud $crud, string $table, string $parentColumn, string $childColumn)
    {
        parent::__construct($crud);
        $this->database->table = $table;
        $this->parentColumn  = $parentColumn;
        $this->childColumn   = $childColumn;
    }

    /**
     * Sets the alias of the table.
     *
     * @param string $name
     *
     * @return $this
     */
    public function alias(string $name)
    {
        $this->alias = $name;

        return $this;
    }
}

<?php

namespace Admin\Read\Relations;

use Admin\Connection;
use Admin\Read\Tables\InlineTable;

class OneMany extends InlineTable
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
     * OneOne constructor.
     *
     * @param Connection   $connection
     * @param string $table
     * @param string $parentColumn
     * @param string $childColumn
     */
    public function __construct(Connection $connection, string $table, string $parentColumn, string $childColumn)
    {
        parent::__construct($connection);
        $this->database->table = $table;
        $this->parentColumn    = $parentColumn;
        $this->childColumn     = $childColumn;
    }
}

<?php

namespace Admin\Database;

use Admin\Connection;

class Table
{

    /**
     * The connection of
     *
     * @var Connection
     */
    protected $connection;

    /**
     * Name of the table.
     *
     * @var string
     */
    protected $name;

    /**
     * @var RelationCollector
     */
    protected $relations;

    /**
     * Table constructor.
     *
     * @param Connection $connection the connection to the database.
     * @param string     $name       the name of the table.
     */
    public function __construct(Connection $connection, string $name)
    {
        $this->connection = $connection;
        $this->name       = $name;
    }
}
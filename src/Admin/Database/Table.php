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
    public $table;

    /**
     * The relations of the table.
     *
     * @var RelationCollector
     */
    public $relations;

    /**
     * Table constructor.
     *
     * @param Connection $connection an instance of connection.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->relations  = new RelationCollector($this);
    }

    /**
     * Gets the connection of the table.
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Sets the connection of the table.
     *
     * @param Connection $connection the connection to set.
     *
     * @return Table
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Gets the name of the table.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets the name of the table.
     *
     * @param string $table the name to set.
     *
     * @return Table
     */
    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Gets the relations of the Table instance.
     *
     * @return RelationCollector
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Sets the relationCollector instance of the table.
     *
     * @param RelationCollector $relations
     *
     * @return Table
     */
    public function setRelations(RelationCollector $relations)
    {
        $this->relations = $relations;

        return $this;
    }
}

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
     * The relations of the table.
     *
     * @var RelationCollector
     */
    protected $relations;

    /**
     * Table constructor.
     *
     * @param string $name the name of the table.
     */
    public function __construct(string $name)
    {
        $this->name      = $name;
        $this->relations = new RelationCollector($this);
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the table.
     *
     * @param string $name the name to set.
     *
     * @return Table
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
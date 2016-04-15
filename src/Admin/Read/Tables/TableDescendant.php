<?php

namespace Admin\Read\Tables;

use Admin\Connection;
use Admin\Database\TableRelation;

class TableDescendant extends Table
{

    /**
     * Relation that defines the TableDescendant.
     *
     * @var TableRelation
     */
    protected $relation;

    /**
     * Whether or not the table is inline.
     *
     * @var bool
     */
    protected $inline = true;

    /**
     * Alias of the table in the main table.
     *
     * @var string
     */
    protected $alias;

    /**
     * TableDescendant constructor.
     *
     * @param Connection $connection instance of connection.
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * Sets the alias of the table column in the main table.
     *
     * @param string $alias the alias to set.
     *
     * @return $this
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Gets the alias of the table.
     *
     * @return $this
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Gets the relation of the TableDescendant.
     *
     * @return TableRelation
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Sets the relation of the TableDescendant instance.
     *
     * @param TableRelation $relation the relation.
     *
     * @return $this
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }
}

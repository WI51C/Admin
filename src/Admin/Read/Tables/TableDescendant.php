<?php

namespace Admin\Read\Tables;

use Admin\Connection;

class TableDescendant extends Table
{

    /**
     * Text to display in the button to open the table.
     *
     * @var string
     */
    public $open = 'Open';

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
    public $inline = true;

    /**
     * Alias of the table in the main table.
     *
     * @var string
     */
    public $alias;

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
     * Gets the text to display in the button to open the table.
     *
     * @return string
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Sets the text to display in the button to open the table.
     *
     * @param string $open the text to display.
     *
     * @return TableDescendant
     */
    public function setOpen(string $open)
    {
        $this->open = $open;

        return $this;
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
        return $this->alias ?? $this->table;
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

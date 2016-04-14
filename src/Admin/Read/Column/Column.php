<?php

namespace Admin\Read\Column;

use Admin\Read\AttributeCollector;

abstract class Column extends AttributeCollector
{

    /**
     * The name of the column in the database.
     *
     * @var string
     */
    public $name;

    /**
     * The alias (header) of the column.
     *
     * @var string
     */
    public $alias;

    /**
     * Position in the table.
     *
     * @var int
     */
    public $position = 100;

    /**
     * Whether or not the column is custom.
     *
     * @var bool
     */
    protected $custom = false;

    /**
     * Column constructor.
     *
     * @param string $name     the name of the column in the database.
     * @param string $alias    the alias (header) to display in the table.
     * @param int    $position the position of the column in the table.
     */
    public function __construct(string $name, string $alias, int $position = 100)
    {
        $this->name     = $name;
        $this->alias    = $alias;
        $this->position = $position;
    }

    /**
     * Sets the name of the column.
     *
     * @param string $name the string to set as the name.
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the name of the column.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the alias of the column.
     *
     * @param string $alias the string to set as the alias.
     *
     * @return $this
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Gets the alias of the column.
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias ?? $this->name;
    }

    /**
     * Sets the position of the column in the table.
     *
     * @param int $position to position to set.
     *
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Gets the position of the column in the table.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Returns whether or not the column is custom.
     *
     * @return bool
     */
    public function isCustom()
    {
        return $this->custom;
    }
}

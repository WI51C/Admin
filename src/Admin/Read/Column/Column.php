<?php

namespace Admin\Read\Column;

use Admin\Read\AttributeCollector;
use InvalidArgumentException;

class Column
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
     * Modifier of the column, the <td> value and current row will be passed to the callback.
     *
     * @var callable
     */
    public $modifier;

    /**
     * Column constructor.
     *
     * @param string        $name     the name of the column in the database.
     * @param string        $alias    the alias (header) to display in the table.
     * @param int           $position the position of the column in the table.
     * @param callable|null $modifier the modifier of the column.
     */
    public function __construct(string $name, string $alias, int $position, $modifier)
    {
        if ($modifier !== null && !is_callable($modifier)) {
            throw new InvalidArgumentException(sprintf('The modifier for %s is invalid.', $name));
        }

        $this->name     = $name;
        $this->alias    = $alias;
        $this->position = $position;
        $this->modifier = $modifier;
    }

    /**
     * Gets the content of the <td> tag.
     *
     * @param mixed $value the value to display.
     * @param array $row   the current row.
     *
     * @return mixed
     */
    public function content($value, array $row)
    {
        return $this->modifier ? call_user_func($this->modifier, $value, $row) : $value;
    }

    /**
     * Gets the modifier of the column.
     *
     * @return callable
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * Sets the modifier of the column.
     *
     * @param callable $modifier the callback to set.
     *
     * @return $this
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;

        return $this;
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
}

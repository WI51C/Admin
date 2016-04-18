<?php

namespace Admin\Read\Column;

use Admin\Read\AttributeCollector;

class Column
{

    /**
     * The name of the column in the database.
     *
     * @var string
     */
    public $name;

    /**
     * The header (header) of the column.
     *
     * @var string
     */
    public $header;

    /**
     * Position in the table.
     *
     * @var int
     */
    public $position = 100;

    /**
     * Attributes of the column.
     *
     * @var AttributeCollector
     */
    public $attributes;

    /**
     * Whether or not the user should be able to sort in the column.
     *
     * @var bool
     */
    public $sortable = true;

    /**
     * Whether or not the user should be able to search in the column.
     *
     * @var bool
     */
    public $searchable = true;

    /**
     * Whether or not the user should be able to select from the values in the array from a <select> tag.
     *
     * @var bool
     */
    public $selectable = false;

    /**
     * Modifiers of the column.
     *
     * @var array
     */
    public $modifiers = [];

    /**
     * Column constructor.
     *
     * @param string $name     the name of the column in the database.
     * @param string $header   the header (header) to display in the table.
     * @param int    $position the position of the column in the table.
     */
    public function __construct(string $name, string $header, int $position)
    {
        $this->name       = $name;
        $this->header     = $header;
        $this->position   = $position;
        $this->attributes = new AttributeCollector();
    }

    /**
     * Apply a modifier to the column.
     *
     * @param callable $callback   to callback that produces the result of the <td> tag.
     * @param array    $parameters the parameters to pass to the callback are:
     *                             - $val the current value.
     *                             - $row the current row.
     *                             - $pos the position (index) of the current row.
     *                             - Any value that doesnt match any of the above will be passed to the callback.
     *
     * @return $this
     */
    public function apply(callable $callback, array $parameters = ['$val'])
    {
        $this->modifiers[] = [
            $callback,
            $parameters,
        ];

        return $this;
    }

    /**
     * Modifies a value using the modifiers defined in the column instance.
     *
     * @param mixed $value    the current value.
     * @param array $row      the current row.
     * @param int   $position the position (index) of the current row.
     *
     * @return mixed
     */
    public function modify($value, array $row, int $position)
    {
        foreach ($this->modifiers as $modifier) {
            foreach ($modifier[1] as $i => $parameter) {
                if ($parameter === '$val')
                    $modifier[1][$i] = $value;
                elseif ($parameter === '$row')
                    $modifier[1][$i] = $row;
                elseif ($parameter === '$pos')
                    $modifier[1][$i] = $position;
            }

            $value = call_user_func_array($modifier[0], $modifier[1]);
        }

        return $value;
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
     * Sets the header of the column.
     *
     * @param string $header the string to set as the header.
     *
     * @return $this
     */
    public function setHeader(string $header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Gets the header of the column.
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header ?? $this->name;
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
     * @return AttributeCollector
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param AttributeCollector $attributes
     *
     * @return Column
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Gets whether or not the user should be able to sort in the column.
     *
     * @return boolean
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * Sets whether or not the user should be able to sort in the column.
     *
     * @param boolean $sortable the value to set.
     *
     * @return $this
     */
    public function setSortable(bool $sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * Gets whether or not the user should be able to search in the column.
     *
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * Sets whether or not the user should be able to search in the column.
     *
     * @param boolean $searchable the value to set.
     *
     * @return $this
     */
    public function setSearchable(bool $searchable)
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * Gets whether or not the user should be able to select from the values in the array from a <select> tag.
     *
     * @return boolean
     */
    public function isSelectable()
    {
        return $this->selectable;
    }

    /**
     * Sets whether or not the user should be able to select from the values in the array from a <select> tag.
     *
     * @param boolean $selectable the value to set.
     *
     * @return $this
     */
    public function setSelectable(bool $selectable)
    {
        $this->selectable = $selectable;

        return $this;
    }

    /**
     * Gets the modifiers of the column.
     *
     * @return array
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    /**
     * Sets the modifiers of the column.
     *
     * @param array $modifiers the modifier to set.
     *
     * @return $this
     */
    public function setModifiers(array $modifiers)
    {
        $this->modifiers = $modifiers;

        return $this;
    }
}

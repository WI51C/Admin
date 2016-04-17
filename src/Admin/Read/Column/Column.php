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
            foreach ($modifier[1] as $position => $parameter) {
                if ($parameter === '$val')
                    $modifier[1][$position] = $value;
                elseif ($parameter === '$row')
                    $modifier[1][$position] = $row;
                elseif ($parameter === '$pos')
                    $modifier[1][$position] = $position;
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
}

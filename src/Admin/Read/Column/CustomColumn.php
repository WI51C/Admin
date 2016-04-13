<?php

namespace Admin\Read\Column;

class CustomColumn extends Column
{

    /**
     * A callback to produce the content of the column.
     *
     * @var callable
     */
    protected $callable;

    /**
     * Column constructor.
     *
     * @param string   $name     the name of the column in the database.
     * @param string   $alias    the alias (header) to display in the table.
     * @param int      $position the position of the column in the table.
     * @param callable $callable the callable to produce the callable of the columns <td> tags.
     */
    public function __construct(string $name, $alias, int $position, callable $callable)
    {
        parent::__construct($name, $alias, $position);

        $this->callable = $callable;
    }

    /**
     * Sets the callable callable of the custom column.
     *
     * @param callable $callable the callable to set.
     *
     * @return $this
     */
    public function setCallable(callable $callable)
    {
        $this->callable = $callable;

        return $this;
    }

    /**
     * Gets the callable callable of the custom column.
     *
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }
}
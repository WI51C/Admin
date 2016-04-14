<?php

namespace Admin\Read\Column;

class CustomColumn extends Column
{

    /**
     * A callback to produce the content of the column.
     *
     * @var callable
     */
    protected $result;

    /**
     * Column constructor.
     *
     * @param string   $name     the name of the column in the database.
     * @param string   $alias    the alias (header) to display in the table.
     * @param int      $position the position of the column in the table.
     * @param callable $result   the callable to produce the callable of the columns <td> tags.
     */
    public function __construct(string $name, $alias, int $position, callable $result)
    {
        parent::__construct($name, $alias, $position);

        $this->result = $result;
    }

    /**
     * Sets the result callable of the custom column.
     *
     * @param callable $result the callable to set.
     *
     * @return $this
     */
    public function setResult(callable $result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Gets the callable callable of the custom column.
     *
     * @return callable
     */
    public function getResult()
    {
        return $this->result;
    }
}
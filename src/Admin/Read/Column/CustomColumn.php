<?php

namespace Admin\Read\Column;

class CustomColumn
{

    /**
     * The header of the custom column.
     *
     * @var string
     */
    public $header;

    /**
     * The position of the column in the table.
     *
     * @var int
     */
    public $position;

    /**
     * Callback to produce the result of the column.
     *
     * @var callable
     */
    public $callable;

    /**
     * Whether or not the column is custom.
     *
     * @var bool
     */
    public $custom = true;

    /**
     * CustomColumn constructor.
     *
     * @param string   $header   the header of the column.
     * @param int      $position the position of the column in the table.
     * @param callable $callable the callback that produces the result of the table.
     */
    public function __construct(string $header, int $position, callable $callable)
    {
        $this->header   = $header;
        $this->position = $position;
        $this->callable = $callable;
    }

    /**
     * Gets the header of the column.
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Sets the header of the column.
     *
     * @param string $header the column to set.
     *
     * @return $this
     */
    public function setHeader(string $header)
    {
        $this->header = $header;

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
     * Sets the position of the column in the table.
     *
     * @param int $position the position to set.
     *
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Gets the callable that produces the value of the column.
     *
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * Sets the callable value that produces the value of the column.
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
}

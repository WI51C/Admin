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
     * Transformers of the column.
     *
     * @var Transformers
     */
    public $transformers;

    /**
     * Attributes of the column.
     *
     * @var AttributeCollector
     */
    public $attributes;

    /**
     * Column constructor.
     *
     * @param string $name     the name of the column in the database.
     * @param string $header   the header (header) to display in the table.
     * @param int    $position the position of the column in the table.
     */
    public function __construct(string $name, string $header, int $position)
    {
        $this->name         = $name;
        $this->header       = $header;
        $this->position     = $position;
        $this->transformers = new Transformers();
        $this->attributes   = new AttributeCollector();
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

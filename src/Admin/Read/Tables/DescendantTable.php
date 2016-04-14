<?php

namespace Admin\Read\Tables;

class DescendantTable extends Table
{

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
     * Message to show in the link to inspect the table.
     *
     * @var string
     */
    protected $button = 'SHOW';

    /**
     * Sets the message property of the table.
     *
     * @param string $message the message to display.
     *
     * @return $this
     */
    public function setButton(string $message)
    {
        $this->button = $message;

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
     * Gets the button message of the inline table.
     *
     * @return string
     */
    public function getButton()
    {
        return $this->button;
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
}

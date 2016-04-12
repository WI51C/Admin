<?php

namespace Admin\Read\Tables;

class InlineTable extends Table
{

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
    protected $message = 'Display';

    /**
     * Sets the message property of the table.
     *
     * @param string $message the message to display.
     *
     * @return $this
     */
    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Sets the alias of the table column in the main table.
     *
     * @param string $alias the alias to set.
     *
     * @return $this
     */
    public function alias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Gets the message of the inline table.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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
<?php

namespace Admin\Read\Tables;

class TableDescendant extends Table
{

    /**
     * Text to display in the button to open the table.
     *
     * @var string
     */
    public $openMessage = 'OPEN';

    /**
     * Text to display in the button to close the table.
     *
     * @var string
     */
    public $closeMessage = 'EXIT';

    /**
     * Whether or not the table is inline.
     *
     * @var bool
     */
    public $inline = true;

    /**
     * Header of the table in the main table.
     *
     * @var string
     */
    public $header;

    /**
     * Gets the text to display in the button to open the table.
     *
     * @return string
     */
    public function getOpenMessage()
    {
        return $this->openMessage;
    }

    /**
     * Sets the text to display in the button to open the table.
     *
     * @param string $open the text to display.
     *
     * @return TableDescendant
     */
    public function setOpenMessage(string $open)
    {
        $this->openMessage = $open;

        return $this;
    }

    /**
     * Gets the message to display in the button to close the table.
     *
     * @return string
     */
    public function getCloseMessage()
    {
        return $this->closeMessage;
    }

    /**
     * Gets the message to display in the button to close the table.
     *
     * @param string $closeMessage the message to set.
     *
     * @return $this
     */
    public function setCloseMessage(string $closeMessage)
    {
        $this->closeMessage = $closeMessage;

        return $this;
    }

    /**
     * Sets the header of the table column in the main table.
     *
     * @param string $header the header to set.
     *
     * @return $this
     */
    public function setHeader(string $header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Gets the header of the table.
     *
     * @return $this
     */
    public function getHeader()
    {
        return $this->header ?? $this->table;
    }
}

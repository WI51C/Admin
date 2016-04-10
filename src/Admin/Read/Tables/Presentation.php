<?php

namespace Admin\Read\Tables;

class Presentation
{

    /**
     * Caption of the html table.
     *
     * @var string
     */
    public $caption;

    /**
     * Columns of the table.
     *
     * @var array
     */
    public $columns = [];

    /**
     * Sets the caption of the table.
     *
     * @param string $caption
     *
     * @return $this
     */
    public function caption(string $caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Sets the columns property of the object.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }
}

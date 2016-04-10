<?php

namespace Admin\Read\Renderer;

class TableRenderer
{

    /**
     * Headers to display in the table.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Columns to display in the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Data to display in the table.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Constructs and returns the html for the table.
     *
     * @return string
     */
    public function render()
    {
        return require('../templates/table.template.php');
    }

    /**
     * Sets the headers of the table.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Sets the columns to display in the table.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Sets the data of the table.
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Gets the template of the TableRenderer.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}

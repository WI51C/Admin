<?php

namespace Admin\Read\Process;

use Admin\Read\Tables\Table;
use Exception;
use InvalidArgumentException;

class Renderer
{

    /**
     * Template to load and render.
     *
     * @var string
     */
    protected $template = '../templates/table.template.php';

    /**
     * Table to render.
     *
     * @var Table
     */
    protected $table;

    /**
     * The array of data to display.
     *
     * @var array
     */
    protected $data;

    /**
     * The columns to display in the table.
     *
     * @var array
     */
    protected $headers;

    /**
     * Renderer constructor.
     *
     * @param Table $table
     * @param array $data
     * @param array $columns
     */
    public function __construct(Table $table, array $data, array $columns)
    {
        $this->table   = $table;
        $this->data    = $data;
        $this->columns = $columns;
    }

    /**
     * Renders the data using the presenter of the table to render.
     *
     * @throws Exception if the template has an invalid filename.
     *
     * @return string
     */
    public function render()
    {
        if (!file_exists($this->template)) {
            throw new Exception(sprintf('Template file %s does not exist.', $this->template));
        }

        ob_start();
        require($this->template);

        return ob_get_clean();
    }

    /**
     * Sets the template property of the renderer.
     *
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate(string $template)
    {
        if (!file_exists($template)) {
            throw new InvalidArgumentException(sprintf('The template %s does not exist.', $template));
        }

        $this->template = $template;

        return $this;
    }

    /**
     * Returns the template file name.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Gets the table instance of the renderer.
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets the table instance of the renderer.
     *
     * @param Table $table
     *
     * @return $this
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Gets the data array of the renderer.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the data array of the renderer.
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}

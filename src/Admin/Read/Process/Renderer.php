<?php

namespace Admin\Read\Process;

use Admin\Read\Column\ColumnCollector;
use Admin\Read\Tables\Table;
use Exception;

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
    protected $columns;

    /**
     * Renderer constructor.
     *
     * @param Table           $table   the table to render.
     * @param array           $data    the data to render in the table.
     * @param ColumnCollector $columns the columns to display in the table.
     */
    public function __construct(Table $table, array $data, ColumnCollector $columns)
    {
        $this->data    = $data;
        $this->table   = $table;
        $this->columns = $columns->sort();
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
        include($this->template);
        $output = ob_get_clean();

        return $output;
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

    /**
     * Sets the columns of the Renderer.
     *
     * @param ColumnCollector $columns the columns to display in the table.
     *
     * @return $this
     */
    public function setColumns(ColumnCollector $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Gets the columns of the renderer.
     *
     * @return ColumnCollector
     */
    public function getColumns()
    {
        return $this->columns;
    }
}

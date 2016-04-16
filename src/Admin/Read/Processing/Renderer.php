<?php

namespace Admin\Read\Build;

use Admin\Read\Tables\Table;

class Renderer
{

    /**
     * The table to render.
     *
     * @var Table
     */
    protected $table;

    /**
     * The columns of the table to render.
     *
     * @var array
     */
    protected $columns;

    /**
     * The data to render in the table.
     *
     * @var array
     */
    protected $data;

    /**
     * Renderer constructor.
     *
     * @param Table $table the table to render.
     * @param array $data  the data to render in the table.
     */
    public function __construct(Table $table, array $data)
    {
        $this->table   = $table;
        $this->columns = $table->columns->getColumns();
        $this->data    = $data;
    }

    /**
     * Returns the HTML of the table.
     *
     * @return string
     */
    public function render()
    {
        ob_start();
        include('../templates/table.template.php');
        $content = ob_get_clean();

        return $content;
    }
}

<?php

namespace Admin\Read\Process;

use Admin\Read\Tables\Presenter;

class Renderer
{

    /**
     * Presenter instance of the Table to render.
     *
     * @var Presenter
     */
    protected $presenter;

    /**
     * The array of data to display.
     *
     * @var array
     */
    protected $data;

    /**
     * Renderer constructor.
     *
     * @param Presenter $presenter
     * @param array     $data
     */
    public function __construct(Presenter $presenter, array $data)
    {
        $this->presenter = $presenter;
        $this->data      = $data;
    }

    /**
     * Renders the data using the presenter of the table to render.
     *
     * @return string
     */
    public function render()
    {
        return include '../templates/table.template.php';
    }
}

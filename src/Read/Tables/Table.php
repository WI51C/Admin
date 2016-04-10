<?php

namespace Admin\Read\Tables;

use Admin\Crud;

class Table
{

    /**
     * Instance of CRUD.
     *
     * @var Crud
     */
    protected $crud;

    /**
     * Configuration of the HTML of the Table.
     *
     * @var Html
     */
    public $html;

    /**
     * Configuration of the presentation of the Table.
     *
     * @var Presentation
     */
    public $presentation;

    /**
     * Configuration of the SQL of the Table.
     *
     * @var SQL
     */
    public $sql;

    /**
     * Table constructor.
     *
     * @param Crud $crud
     */
    public function __construct(Crud $crud)
    {
        $this->crud         = $crud;
        $this->html         = new Html();
        $this->presentation = new Presentation();
        $this->sql          = new SQL();
    }
}

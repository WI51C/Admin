<?php

namespace Admin\Modules;

use Admin\CRUD;

class Update implements Contract
{

    /**
     * Instance of CRUD.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * Table of the create instance.
     *
     * @var string
     */
    protected $table;

    /**
     * Read constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
    }

    /**
     * Sets the table of the create instance.
     *
     * @param string $table
     *
     * @return $this
     */
    public function table(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Returns the content to show on create.
     *
     * @return string
     */
    public function render()
    {
        return 'update';
    }
}

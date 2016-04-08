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
     * Read constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
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

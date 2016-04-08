<?php

namespace Admin\Relations;

use Admin\CRUD;

class OTO
{

    /**
     * CRUD instance.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * OTO constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
    }
}

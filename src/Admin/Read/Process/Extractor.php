<?php

namespace Admin\Read\Process;

use Admin\Crud;
use Admin\Read\Tables\Table;

class Extractor
{

    /**
     * Instance of Crud.
     *
     * @var Crud
     */
    private $crud;

    /**
     * The table to extract data from.
     *
     * @var Table
     */
    private $table;

    /**
     * Extractor constructor.
     *
     * @param Crud  $crud
     * @param Table $table
     */
    public function __construct(Crud $crud, Table $table)
    {
        $this->crud  = $crud;
        $this->table = $table;
    }

    /**
     * Returns an array containing the
     */
    public function extract()
    {

    }
}

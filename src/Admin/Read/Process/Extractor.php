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
     * Accumulated data.
     *
     * @var array
     */
    protected $data;

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
        $this->getPrimaryData();

        return $this->data;
    }

    /**
     * Gets the primary data of the table.
     *
     * @return void
     */
    protected function getPrimaryData()
    {
        $query = $this->crud->query();
        foreach ($this->table->sql->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        $this->data = $query->get($this->table->sql->table, [$this->table->sql->offset, $this->table->sql->limit]);
    }
}

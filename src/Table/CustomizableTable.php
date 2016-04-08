<?php

namespace Admin\Table;

use Admin\CRUD;
use Admin\Relations\RelationMapper;

class CustomizableTable
{

    /**
     * Map of relations to the Table.
     *
     * @var RelationMapper
     */
    public $map;

    /**
     * The instance of CRUD.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * CustomizableTable constructor.
     *
     * @param CRUD $CRUD the CRUD of the instance.
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
        $this->map  = new RelationMapper($CRUD);
    }
}

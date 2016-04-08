<?php

namespace Admin\Read;

use Admin\CRUD;
use Closure;
use Admin\Read\Inline\ManyToManyTable;
use Admin\Read\Inline\OneToManyTable;

class RelationCollector
{

    /**
     * The defined One-To-One relations of the collector.
     *
     * @var array
     */
    protected $oto = [];

    /**
     * The defined One-To-Many relations of the collector.
     *
     * @var array
     */
    protected $otm = [];

    /**
     * The defined Many-To-Many relations of the collector.
     *
     * @var array
     */
    protected $mtm = [];

    /**
     * Instance of CRUD.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * The table of the InlineCollector.
     *
     * @var Table
     */
    protected $table;

    /**
     * InlineCollector constructor.
     *
     * @param CRUD  $CRUD
     * @param Table $table
     */
    public function __construct(CRUD $CRUD, Table $table)
    {
        $this->CRUD  = $CRUD;
        $this->table = $table;
    }

    /**
     * Joins another table.
     *
     * @param string $table     the table to join on.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     *
     * @return $this
     */
    public function oto(string $table, string $condition, string $type = 'INNER')
    {
        $this->oto[] = [
            $table,
            $condition,
            $type,
        ];

        return $this;
    }

    /**
     * Joins another table.
     *
     * @return $this
     */
    public function otm()
    {

    }

    /**
     * Joins another table.
     *
     * @return $this
     */
    public function mtm()
    {

    }

    /**
     * Gets the One-To-One relations of the collector.
     *
     * @return array
     */
    public function getOTORelations()
    {
        return $this->oto;
    }

    /**
     * Gets the One-To-Many relations of the collector.
     *
     * @return array
     */
    public function getOTMRelations()
    {
        return $this->otm;
    }

    /**
     * Gets the Many-To-Many relations of the collector.
     *
     * @return array
     */
    public function getMTMRelations()
    {
        return $this->mtm;
    }
}

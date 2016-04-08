<?php

namespace Admin\Read;

use Admin\CRUD;
use Closure;
use Admin\Read\Inline\MTMTable;
use Admin\Read\Inline\OTMTable;

class InlineCollector
{

    /**
     * Defined inline-tables of the Collector.
     *
     * @var array
     */
    protected $tables;

    /**
     * Instance of CRUD.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * InlineCollector constructor.
     *
     * @param CRUD $CRUD
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
    }

    /**
     * Creates, stores and returns a new instance of InlineTable.
     *
     * @param Closure $closure closure to modify the table.
     *
     * @return OTMTable
     */
    public function otm(Closure $closure)
    {
        $this->tables[] = call_user_func($closure, new OTMTable($this->CRUD));

        return $this;
    }

    /**
     * Creates, stores and returns a new instance of
     *
     * @param Closure $closure closure to modify the table.
     *
     * @return MTMTable
     */
    public function mtm(Closure $closure)
    {
        $this->tables[] = call_user_func($closure, new MTMTable($this->CRUD));

        return $this;
    }
}

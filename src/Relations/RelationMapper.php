<?php

namespace Admin\Relations;

use Closure;
use Admin\CRUD;

class RelationMapper
{

    /**
     * The defined One-To-One relations.
     *
     * @var array
     */
    protected $oto = [];

    /**
     * The defined One-To-One relations.
     *
     * @var array
     */
    protected $otm = [];

    /**
     * The defined One-To-One relations.
     *
     * @var array
     */
    protected $mtm = [];

    /**
     * Instance of CRUD for accessing global information and resources.
     *
     * @var CRUD
     */
    protected $CRUD;

    /**
     * RelationMapper constructor.
     *
     * @param CRUD $CRUD instance of CRUD.
     */
    public function __construct(CRUD $CRUD)
    {
        $this->CRUD = $CRUD;
    }

    /**
     * Adds an One-To-One relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return $this
     */
    public function oto(Closure $closure)
    {
        $relation = new OTO($this->CRUD);
        call_user_func($closure, $relation);
        $this->oto[] = $relation;

        return $this;
    }

    /**
     * Adds an One-To-Many relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return Relation
     */
    public function otm(Closure $closure)
    {
        $relation = new OTM($this->CRUD);
        call_user_func($closure, $relation);
        $this->otm[] = $relation;

        return $this;
    }

    /**
     * Adds an Many-To-Many relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return Relation
     */
    public function mtm(Closure $closure)
    {
        $relation = new MTM($this->CRUD);
        call_user_func($closure, $relation);
        $this->mtm[] = $relation;

        return $this;
    }
}

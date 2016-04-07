<?php

namespace CRUDL\Relations;

use Closure;
use CRUDL\Controller;
use CRUDL\Relations\Instances\MTMRelation;
use CRUDL\Relations\Instances\OTMRelation;
use CRUDL\Relations\Instances\OTORelation;

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
     * Instance of Controller for accessing global information and resources.
     *
     * @var Controller
     */
    protected $controller;

    /**
     * RelationMapper constructor.
     *
     * @param Controller $controller instance of Controller.
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Adds an One-To-One relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return $this
     */
    public function newOTO(Closure $closure)
    {
        $relation = new OTORelation($this->controller);
        call_user_func($closure, $relation);
        $this->oto[] = $relation;

        return $this;
    }

    /**
     * Adds an One-To-One relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return Relation
     */
    public function newOTM(Closure $closure)
    {
        $relation = new OTMRelation($this->controller);
        call_user_func($closure, $relation);
        $this->otm[] = $relation;

        return $this;
    }

    /**
     * Adds an One-To-One relation to the map.
     *
     * @param Closure $closure a closure to interact with the relation with.
     *
     * @return Relation
     */
    public function newMTM(Closure $closure)
    {
        $relation = new MTMRelation($this->controller);
        call_user_func($closure, $relation);
        $this->mtm[] = $relation;

        return $this;
    }

    /**
     * Gets the data from all the
     *
     * @return string
     */
    public function getRelationData()
    {
        return [];
    }
}

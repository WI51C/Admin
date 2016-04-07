<?php

namespace CRUDL\Relations;

use Closure;
use CRUDL\Controller;

class TabularRelation extends Relation
{

    /**
     * The number of rows to select from the table.
     *
     * @var array
     */
    protected $rows = [];

    /**
     * Closure for sorting the table data with.
     *
     * @var Closure|null
     */
    protected $sorting;

    /**
     * Instance of RelationMapper for nesting relations.
     *
     * @var RelationMapper
     */
    public $map;

    /**
     * Instance of Controller for accessing global information and resources.
     *
     * @var Controller
     */
    protected $controller;

    /**
     * RelationTable constructor.
     *
     * @param Controller $controller the controller instance.
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
        $this->map        = new RelationMapper($controller);
    }

    /**
     * Sets the number of rows to display.
     *
     * @param int $rows
     *
     * @return $this
     */
    public function rows(int $rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Register a closure for editing the sorting of the table data.
     *
     * @param Closure $closure
     *
     * @return $this
     */
    public function sorting(Closure $closure)
    {
        $this->sorting = $closure;

        return $this;
    }

    /**
     * Gets the data of the tabular relation table.
     *
     * @return array
     */
    public function getData()
    {
        return [
            'primary'    => $this->getPrimaryData(),
            'relational' => $this->map->getRelationData(),
        ];
    }

    /**
     * Gets the primary data of the table.
     *
     * This means no relational data will be retrieved.
     *
     * @return array
     */
    public function getPrimaryData()
    {
        
    }
}
<?php

namespace Admin\Read\Tables;

use Admin\Database\TableRelation;

class VisualTableDescendant extends VisualTable
{

    /**
     * Relation that defines the VisualTableDescendant.
     *
     * @var TableRelation
     */
    protected $relation;

    /**
     * Whether or not the table is inline.
     *
     * @var bool
     */
    protected $inline = true;

    /**
     * Alias of the table in the main table.
     *
     * @var string
     */
    protected $alias;

    /**
     * VisualTableDescendant constructor.
     *
     * @param TableRelation $relation the relation that defined the VisualTableDescendant.
     */
    public function __construct(TableRelation $relation)
    {
        parent::__construct();

        $this->relation = $relation;
    }

    /**
     * Sets the alias of the table column in the main table.
     *
     * @param string $alias the alias to set.
     *
     * @return $this
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Gets the alias of the table.
     *
     * @return $this
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Gets the relation of the VisualTableDescendant.
     *
     * @return TableRelation
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Sets the relation of the VisualTableDescendant instance.
     *
     * @param TableRelation $relation the relation.
     *
     * @return $this
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }
}

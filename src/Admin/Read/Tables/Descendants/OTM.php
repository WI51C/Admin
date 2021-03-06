<?php

namespace Admin\Read\Tables\Descendants;

use Admin\Read\Tables\Table;
use Admin\Read\Tables\TableDescendant;

class OTM extends TableDescendant
{

    /**
     * Parent of the relation.
     *
     * @var Table
     */
    public $parent;

    /**
     * The table of the join.
     *
     * @var string
     */
    public $table;

    /**
     * The parent column of the condition of the join.
     *
     * @var string
     */
    public $parentColumn;

    /**
     * The descendant column of the condition of the join.
     *
     * @var string
     */
    public $descendantColumn;

    /**
     * The type of join to perform.
     *
     * @var string
     */
    public $type;

    /**
     * All relational data.
     *
     * @var array
     */
    protected $relationalData;

    /**
     * Current relational (parent) value.
     *
     * @var mixed
     */
    protected $currentRelation;

    /**
     * OTO constructor.
     *
     * @param Table  $parent           parent of the relation.
     * @param string $table            the of the table to relate to.
     * @param string $parentColumn     the parent column of the condition.
     * @param string $descendantColumn the descendant column of the condition.
     */
    public function __construct(Table $parent, string $table, string $parentColumn, string $descendantColumn)
    {
        parent::__construct($parent->getConnection());

        $this->parent           = $parent;
        $this->table            = $table;
        $this->parentColumn     = strtolower($parentColumn);
        $this->descendantColumn = strtolower($descendantColumn);
    }

    /**
     * Gets the relational data matching the current relational data.
     *
     * @return array
     */
    public function getData()
    {
        if ($this->relationalData === null) {
            $this->relationalData = parent::getData();
        }

        return array_filter($this->relationalData, function (array $row) {
            return $row[$this->descendantColumn] === $this->currentRelation;
        });
    }

    /**
     * Gets the parent of the relation.
     *
     * @return Table
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent of the OTO relation.
     *
     * @param Table $parent the parent to set.
     *
     * @return $this
     */
    public function setParent(Table $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Gets the parent column of the condition.
     *
     * @return string
     */
    public function getParentColumn()
    {
        return $this->parentColumn;
    }

    /**
     * Sets the parent column of the condition.
     *
     * @param string $parentColumn the column.
     *
     * @return $this
     */
    public function setParentColumn(string $parentColumn)
    {
        $this->parentColumn = strtolower($parentColumn);

        return $this;
    }

    /**
     * Gets the descendant column of the condition.
     *
     * @return string
     */
    public function getDescendantColumn()
    {
        return $this->descendantColumn;
    }

    /**
     * Sets the descendant column of the condition.
     *
     * @param string $descendantColumn the column.
     *
     * @return $this
     */
    public function setDescendantColumn(string $descendantColumn)
    {
        $this->descendantColumn = strtolower($descendantColumn);

        return $this;
    }

    /**
     * Sets the table to join on.
     *
     * @param string $table the name of the table to join on.
     *
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Gets the table of the join.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Gets the current relational data.
     *
     * @return array
     */
    public function getRelationalData()
    {
        if ($this->relationalData === null) {
            $this->relationalData = $this->getData();
        }

        return $this->relationalData;
    }

    /**
     * Sets the current relational data.
     *
     * @param array $relationalData the array to set.
     *
     * @return $this
     */
    public function setRelationalData(array $relationalData)
    {
        $this->relationalData = $relationalData;

        return $this;
    }

    /**
     * Gets the current relational value.
     *
     * @return mixed
     */
    public function getCurrentRelation()
    {
        return $this->currentRelation;
    }

    /**
     * Sets the current relation. Used when calling getData().
     *
     * @param mixed $currentRelation the current relational value.
     *
     * @return $this
     */
    public function setCurrentRelation($currentRelation)
    {
        $this->currentRelation = $currentRelation;

        return $this;
    }
}

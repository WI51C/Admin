<?php

namespace Admin\Read\Relations;

use Admin\Crud;

class MTM extends OTM
{

    /**
     * The middle table.
     *
     * @var string
     */
    public $middleJoinTable;

    /**
     * The condition to join the middle and primary table.
     *
     * @var string
     */
    public $middleJoinCondition;

    /**
     * The join type of the middle and primary table relation.
     *
     * @var string
     */
    public $middleJoinType;

    /**
     * MTM constructor.
     *
     * @param Crud   $crud                instance of Crud for getting global variables.
     * @param string $table               the table to (primary) display.
     * @param string $parentColumn        the parent column to join on.
     * @param string $childColumn         the child column to join on.
     * @param string $middleTable         the table to join the primary table on.
     * @param string $middleJoinCondition the condition to join the middle and primary table on.
     * @param string $middleJoinType      the type of join to perform between to middle and primary table.
     */
    public function __construct(
        Crud $crud,
        string $table,
        string $parentColumn,
        string $childColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType = 'INNER'
    ) {
        $this->crud                = $crud;
        $this->table               = $table;
        $this->parentColumn        = $parentColumn;
        $this->childColumn         = $childColumn;
        $this->middleJoinTable     = $middleTable;
        $this->middleJoinCondition = $middleJoinCondition;
        $this->middleJoinType      = $middleJoinType;
    }

    /**
     * Gets the data of the table, including the middle table content.
     *
     * @return array
     */
    public function getData()
    {
        $query = $this->crud->query();
        $query->join($this->middleJoinTable, $this->middleJoinCondition, $this->middleJoinType);
        foreach ($this->select->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        if ($this->select->offset !== 0) {
            return $query->get($this->select->table, $this->select->limit);
        }

        return $query->get($this->select->table, [$this->select->offset, $this->select->limit]);
    }
}
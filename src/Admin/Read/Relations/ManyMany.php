<?php

namespace Admin\Read\Relations;

use Admin\Connection;

class ManyMany extends OneMany
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
     * ManyMany constructor.
     *
     * @param Connection $connection          instance of Connection for getting global variables.
     * @param string     $table               the table to (primary) display.
     * @param string     $parentColumn        the parent column to join on.
     * @param string     $childColumn         the child column to join on.
     * @param string     $middleTable         the table to join the primary table on.
     * @param string     $middleJoinCondition the condition to join the middle and primary table on.
     * @param string     $middleJoinType      the type of join to perform between to middle and primary table.
     */
    public function __construct(
        Connection $connection,
        string $table,
        string $parentColumn,
        string $childColumn,
        string $middleTable,
        string $middleJoinCondition,
        string $middleJoinType = 'INNER'
    ) {
        parent::__construct($connection, $table, $parentColumn, $childColumn);
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
        $query = $this->connection->query();
        $query->join($this->middleJoinTable, $this->middleJoinCondition, $this->middleJoinType);
        foreach ($this->database->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        if ($this->database->offset !== 0) {
            return $query->get($this->database->table, $this->database->limit);
        }

        return $query->get($this->database->table, [$this->database->offset, $this->database->limit]);
    }
}
<?php

namespace Admin\Read\Relations;

use Admin\Connection;
use Admin\Read\Column\Column;

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
        $this->relations->newOTO($middleTable, $middleJoinCondition, $middleJoinType);
    }

    /**
     * Gets the data of the table, including the middle table content.
     *
     * @return array
     */
    public function getData()
    {
        $query     = $this->connection->query();
        $relations = $this->relations->getOneToOneRelations();
        array_walk($relations, function (OTO $oto) use ($query) {
            $query->join($oto->getTable(), $oto->getCondition(), $oto->getType());
        });

        $columns = array_map(function (Column $column) {
            $name = $column->getName();

            return sprintf('%s "%s"', $name, $name);
        }, $this->columns->getColumns());

        return $query->get($this->table, [$this->offset, $this->limit], $columns);
    }
}

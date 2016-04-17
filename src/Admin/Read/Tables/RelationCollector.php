<?php

namespace Admin\Read\Tables;

use Admin\Read\Tables\Descendants\MTM;
use Admin\Read\Tables\Descendants\OTO;
use Admin\Read\Tables\Descendants\OTM;

class RelationCollector
{

    /**
     * The parent Table instance of the RelationCollector.
     *
     * @var Table
     */
    protected $parent;

    /**
     * The defined One-To-One relations of the collector.
     *
     * @var array
     */
    public $oto = [];

    /**
     * The defined One-To-Many relations of the collector.
     *
     * @var array
     */
    public $otm = [];

    /**
     * The defined Many-To-Many relations of the collector.
     *
     * @var array
     */
    public $mtm = [];

    /**
     * RelationCollector constructor.
     *
     * @param Table $table the parent Table.
     */
    public function __construct(Table $table)
    {
        $this->parent = $table;
    }

    /**
     * Adds an One-To-One relation to another table.
     *
     * @param string $table     the table of the relation.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     *
     * @return $this
     */
    public function oto(string $table, string $condition, string $type = 'INNER')
    {
        $this->oto[] = new OTO($this->parent, $table, $condition, $type);

        return $this;
    }

    /**
     * Adds an One-To-One relation to another table.
     *
     * @param string $table            the table of the relation.
     * @param string $parentColumn     the column of the parent table that relates to the descendant table.
     * @param string $descendantColumn the descendant column to match the value of the parent table.
     *
     * @return TableDescendant
     */
    public function otm(string $table, string $parentColumn, string $descendantColumn)
    {
        if (strpos($parentColumn, '.') === false) {
            $parentColumn = $this->parent->table . '.' . $parentColumn;
        }

        if (strpos($descendantColumn, '.') === false) {
            $descendantColumn = $table . '.' . $descendantColumn;
        }

        $table       = new OTM($this->parent, $table, $parentColumn, $descendantColumn);
        $this->otm[] = $table;

        return $table;
    }

    /**
     * Adds an One-To-Many relation to another table.
     *
     * @param string $table            the table of the relation.
     * @param string $parentColumn     the column of the parent table that relates to the descendant table.
     * @param string $descendantColumn the descendant column to match the value of the parent table.
     * @param string $linkTable        the middle (linking) table of the relation.
     * @param string $linkCondition    the condition to join the linking table to the relation table.
     * @param string $linkType         the type of join to perform on the linking table and the relation table.
     *
     * @return TableDescendant
     */
    public function mtm(
        string $table,
        string $parentColumn,
        string $descendantColumn,
        string $linkTable,
        string $linkCondition,
        string $linkType = 'INNER'
    ) {
        if (strpos($parentColumn, '.') === false) {
            $parentColumn = $this->parent->table . '.' . $parentColumn;
        }

        if (strpos($descendantColumn, '.') === false) {
            $descendantColumn = $table . '.' . $descendantColumn;
        }

        $table       = new MTM($this->parent, $table, $parentColumn, $descendantColumn, $linkTable, $linkCondition, $linkType);
        $this->mtm[] = $table;

        return $table;
    }

    /**
     * @return array
     */
    public function getOto()
    {
        return $this->oto;
    }

    /**
     * @param array $oto
     *
     * @return RelationCollector
     */
    public function setOto($oto)
    {
        $this->oto = $oto;

        return $this;
    }

    /**
     * @return array
     */
    public function getOtm()
    {
        return $this->otm;
    }

    /**
     * @param array $otm
     *
     * @return RelationCollector
     */
    public function setOtm($otm)
    {
        $this->otm = $otm;

        return $this;
    }

    /**
     * @return array
     */
    public function getMtm()
    {
        return $this->mtm;
    }

    /**
     * @param array $mtm
     *
     * @return RelationCollector
     */
    public function setMtm($mtm)
    {
        $this->mtm = $mtm;

        return $this;
    }
}

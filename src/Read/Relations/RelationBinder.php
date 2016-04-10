<?php

namespace Admin\Read\Relations;

use Admin\Crud;
use Admin\Read\Tables\Otm;
use Closure;
use Exception;
use InvalidArgumentException;
use Admin\Read\Tables\Table;

class RelationCollector
{

    /**
     * The defined One-To-One relations of the collector.
     *
     * @var array
     */
    protected $oto = [];

    /**
     * The defined One-To-Many relations of the collector.
     *
     * @var array
     */
    protected $otm = [];

    /**
     * The defined Many-To-Many relations of the collector.
     *
     * @var array
     */
    protected $mtm = [];

    /**
     * Instance of CRUD.
     *
     * @var Crud
     */
    protected $crud;

    /**
     * The table of the InlineCollector.
     *
     * @var Table
     */
    protected $table;

    /**
     * InlineCollector constructor.
     *
     * @param Crud  $crud
     * @param Table $table
     */
    public function __construct(Crud $crud, Table $table)
    {
        $this->crud  = $crud;
        $this->table = $table;
    }

    /**
     * Joins another table.
     *
     * @param string $table     the table to join on.
     * @param string $condition the condition to join on.
     * @param string $type      the type of join to perform.
     *
     * @return $this
     */
    public function oto(string $table, string $condition, string $type = 'INNER')
    {
        $this->oto[] = [
            $table,
            $condition,
            $type,
        ];

        return $this;
    }

    /**
     * Joins another table.
     *
     * @param array   $table     the table to join on, and its optional alias.
     * @param string  $condition the condition to join on.
     * @param string  $type      the type of join to perform.
     * @param Closure $closure   |null   a closure to change the relation.
     *
     * @throws Exception if the $table array was malformed
     *
     * @return $this
     */
    public function otm(array $table, string $condition, string $type = 'INNER', Closure $closure = null)
    {
        if (empty($table)) {
            throw new InvalidArgumentException('The table array cannot be empty.');
        }

        $tableName = is_int($key = array_keys($table)[0]) ? array_values($table)[0] : $key;
        $alias     = array_values($table)[0];

        $relation = new Otm($this->crud, $tableName, $alias, $condition, $type);

        if ($closure !== null) {
            call_user_func($closure, $relation);
        }

        $this->otm[] = $relation;

        return $this;
    }

    /**
     * Gets the One-To-One relations of the collector.
     *
     * @return array
     */
    public function getOneToOneRelations()
    {
        return $this->oto;
    }

    /**
     * Gets the One-To-Many relations of the collector.
     *
     * @return array
     */
    public function getOtmRelations()
    {
        return $this->otm;
    }

    /**
     * Gets the Many-To-Many relations of the collector.
     *
     * @return array
     */
    public function getMtmRelations()
    {
        return $this->mtm;
    }
}

<?php

namespace Admin\Read\Column;

use Admin\Connection;
use Admin\Read\Tables\Descendants\OTO;
use Admin\Read\Tables\Table;

class ColumnResolver
{

    /**
     * The table to resolve columns for.
     *
     * @var Table
     */
    protected $table;

    /**
     * Array of columns.
     *
     * @var array
     */
    protected $columns;

    /**
     * Tables to select from.
     *
     * @var array
     */
    protected $tables;

    /**
     * The connection instance to the database.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * ColumnResolver constructor.
     *
     * @param Table $table the table to auto-resolve for.
     */
    public function __construct(Table $table)
    {
        $this->table      = $table;
        $this->connection = $table->getConnection();
        $this->tables     = [$this->table->getTable()];

        foreach ($this->table->getOto() as $relation) {
            $this->tables[] = $relation->table;
        }
    }

    /**
     * Resolves to columns of the table.
     *
     * @return $this
     */
    public function resolve()
    {
        $query  = $this->connection->query();
        $return = [];

        $query->where('TABLE_SCHEMA', $this->connection->database);
        $query->where('TABLE_NAME', ['IN' => $this->tables]);
        $this->columns = $query->get('information_schema.columns', null, ['COLUMN_NAME', 'TABLE_NAME', 'ORDINAL_POSITION']);

        usort($this->columns, function (array $a, array $b) {
            return $a['TABLE_NAME'] === $b['TABLE_NAME'] ?
                $a['ORDINAL_POSITION'] - $b['ORDINAL_POSITION'] :
                array_search($a['TABLE_NAME'], $this->tables) - array_search($b['TABLE_NAME'], $this->tables);
        });

        foreach ($this->columns as $position => $column) {
            $name          = strtolower(sprintf('%s.%s', $column['TABLE_NAME'], $column['COLUMN_NAME']));
            $return[$name] = new Column($name, $name, $position);
        }

        var_dump($return);

        return $return;
    }
}

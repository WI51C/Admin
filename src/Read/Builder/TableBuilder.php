<?php

namespace Admin\Read\Builder;

use Admin\Crud;
use Admin\Read\Table;

class TableBuilder
{

    /**
     * Instance of crud for using the Crud database information.
     *
     * @var Crud
     */
    protected $crud;

    /**
     * The table structure to build.
     *
     * @var Table
     */
    private $table;

    /**
     * TableBuilder constructor.
     *
     * @param Crud  $crud
     * @param Table $table the table instance to build.
     */
    public function __construct(Crud $crud, Table $table)
    {
        $this->crud  = $crud;
        $this->table = $table;
    }

    /**
     * Builds the table instance.
     *
     * Returns an array with the structure:
     * [
     *      'headers'   => ...,
     *      'data'      => ...,
     * ]
     *
     * @return array
     */
    public function build()
    {
        $this->autoColumns();

        return [
            'headers' => $this->getHeaders(),
            'data'    => $this->getFilteredData(),
        ];
    }

    /**
     * If no columns were specified, all will be found.
     *
     * Sets the columns property of the instance.
     *
     * @return array
     */
    protected function autoColumns()
    {
        if (empty($this->table->columns)) {
            $query = clone $this->crud->connection;
            $query->where('table_schema', $this->crud->database);
            $tables = [$this->table];
            foreach ($this->relations->getOneToOneRelations() as $oto) {
                $tables[] = $oto[0];
            }

            $query->where('table_name', ['IN' => $tables]);
            $this->table->columns = array_map(function ($value) {
                return $value['column_name'];
            }, $query->get('information_schema.columns', null, ['column_name']));
        }

        return $this->table->columns;
    }

    /**
     * Gets the column names to select.
     *
     * @return array
     */
    protected function getColumns()
    {
        $return = [];
        foreach ($this->table->columns as $key => $value) {
            $return[] = is_int($key) ? $value : $key;
        }

        return $return;
    }

    /**
     * Gets the header names to display.
     *
     * @return array
     */
    protected function getHeaders()
    {
        return array_values($this->table->columns);
    }

    /**
     * Gets the filtered data of the table.
     *
     * @return array
     */
    protected function getFilteredData()
    {
        $data    = $this->getData();
        $columns = $this->getColumns();
        foreach ($data as $position => $row) {
            $data[$position] = array_filter($row, function ($column) use ($columns) {
                return in_array($column, $columns);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $data;
    }

    /**
     * Gets the data of the table.
     *
     * Gets the data from the main table, and any One-To-One relations.
     *
     * @return array
     */
    public function getData()
    {
        $query = clone $this->crud->connection;

        foreach ($this->table->relations->getOneToOneRelations() as $oto) {
            $query->join($oto[0], $oto[1], $oto[2]);
        }

        foreach ($this->table->orders as $order) {
            $query->orderBy($order[0], $order[1]);
        }

        foreach ($this->table->havings as $having) {
            $query->having($having[0], $having[1], $having[2], $having[3]);
        }

        foreach ($this->table->wheres as $where) {
            $query->where($where[0], $where[1], $where[2], $where[3]);
        }

        $data = $query->get($this->table->table, [$this->table->offset, $this->table->limit]);

        return $data;
    }
}
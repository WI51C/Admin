<?php

namespace Admin\Read\Build;

use Admin\Read\Tables\Table;
use Exception;

class Retriever
{

    /**
     * The Table instance to retrieve from.
     *
     * @var Table
     */
    public $table;

    /**
     * Data of the table. This array will be populated with relational data.
     *
     * @var array
     */
    public $data = [];

    /**
     * Retriever constructor.
     *
     * @param Table $table the table to retrieve from.
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
        $this->data  = $table->getData();

        $this->retrieve();
    }

    /**
     * Retrieves the data from the table.
     *
     * @throws Exception
     *
     * @return $this
     */
    protected function retrieve()
    {
        foreach (array_merge($this->table->relations->otm, $this->table->relations->mtm) as $relation) {
            $name = '#table.' . $relation->table;
            foreach ($this->data as $dataPosition => $dataRow) {
                $relation->setCurrentRelation($dataRow[$relation->parentColumn]);
                $this->data[$dataPosition][$name] = $relation->render();
            }

            $this->table->columns->add($name, $relation->header ?? $relation->table)
                ->attributes->add('class', 'column-100');
        }

        return $this;
    }

    /**
     * Gets the table instance of the retriever.
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets the table instance of the retriever.
     *
     * @param Table $table the table to set.
     *
     * @return $this
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Gets the data of the retriever.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the data of the retriever.
     *
     * @param array $data the data to retrieve.
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}

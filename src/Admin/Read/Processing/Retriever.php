<?php

namespace Admin\Read\Processing;

use Admin\Read\Tables\Table;
use MongoDB\Driver\Exception\Exception;

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
            $relationData = $relation->getData();
            foreach ($this->data as $dataPosition => $dataRow) {
                $name    = '#table.' . $relation->table;
                $subData = [];
                foreach ($relationData as $relationPosition => $relationRow) {
                    if ($relationRow[$relation->descendantColumn] === $dataRow[$relation->parentColumn]) {
                        $subData[] = $relationRow;
                    }
                }

                $renderer                         = new Renderer($relation, $subData);
                $this->data[$dataPosition][$name] = $renderer->render();
            }

            $this->table->columns->addColumn($name, $relation->getAlias());
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

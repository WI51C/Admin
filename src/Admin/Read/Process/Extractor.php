<?php

namespace Admin\Read\Process;

use Admin\Read\Tables\Table;
use Exception;

class Extractor
{

    /**
     * Table of One-To-Many and Many-To-Many relations to apply to the base data.
     *
     * @var Table
     */
    protected $table;

    /**
     * Data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Headers to display.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Used hashes of the unique names.
     *
     * @var array
     */
    protected $usedHashes = [];

    /**
     * Extractor constructor.
     *
     * @param Table $table the table to extract data from.
     */
    public function __construct(Table $table)
    {
        $this->table   = $table;
        $this->data    = $table->getData();
        $this->columns = $table->getColumns();

        $this->extract();
    }

    /**
     * Extracts data from the defined relations into the base property.
     *
     * @throws Exception
     *
     * @return array
     */
    public function extract()
    {
        foreach (array_merge($this->table->relations->getOneToManyRelations(), $this->table->relations->getManyToManyRelations()) as $relation) {
            $extractor    = new Extractor($relation);
            $relationData = $extractor->getData();
            $columns      = $extractor->getColumns();
            foreach ($this->data as $key => $value) {
                $subData = [];
                foreach ($relationData as $tableKey => $tableRow) {
                    if ($value[$relation->parentColumn] == $tableRow[$relation->childColumn]) {
                        $subData[] = $tableRow;
                    }
                }
                $renderer = new Renderer($relation, $subData, $columns);
                $this->table->column(
                    sprintf('table:%s', $relation->getTable()),
                    $relation->getAlias() ?? $relation->getTable()
                );
                $this->data[$key][sprintf('table:%s', $relation->getTable())] = $renderer->render();
            }
        }

        return $this->data;
    }

    /**
     * Gets the data of the Extractor.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets the headers of the Extractor.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }
}

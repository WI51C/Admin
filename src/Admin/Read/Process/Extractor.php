<?php

namespace Admin\Read\Process;

use Admin\Read\Tables\Table;

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
    protected $data;

    /**
     * Extractor constructor.
     *
     * @param Table $table
     */
    public function __construct(Table $table, array $data)
    {
        $this->table = $table;
        $this->data  = $data;
    }

    /**
     * Extracts data from the defined relations into the base property.
     *
     * @return array
     */
    public function extract()
    {
        foreach (array_merge($this->table->database->relations->getOtmRelations(), $this->table->database->relations->getMtmRelations()) as $table) {
            $tableData = $table->getData();
            foreach ($this->data as $key => $value) {
                $subData = [];
                foreach ($tableData as $tableKey => $tableRow) {
                    if ($value[$table->parentColumn] == $tableRow[$table->childColumn]) {
                        $subData[] = $tableRow;
                    }
                }

                $renderer = new Renderer($table, $subData);
                $this->table->presentation->addColumn(
                    sprintf('_%s_', $table->database->table),
                    $table->alias ?? $table->database->table
                );
                $this->data[$key][sprintf('_%s_', $table->database->table)] = $renderer->render();
            }
        }

        return $this->data;
    }
}

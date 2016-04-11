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
        foreach ($this->table->database->relations->getOtmRelations() as $otm) {
            $otmData = $otm->getData();
            foreach ($this->data as $key => $value) {
                $subData = [];
                foreach ($otmData as $otmKey => $otmRow) {
                    if ($value[$otm->parentColumn] == $otmRow[$otm->childColumn]) {
                        $subData[] = $otmRow;
                    }
                }

                $renderer = new Renderer($otm, $subData);
                $this->table->presentation->addColumn(
                    sprintf('_%s_', $otm->database->table),
                    $otm->alias ?? $otm->database->table
                );
                $this->data[$key][sprintf('_%s_', $otm->database->table)] = $renderer->render();
            }
        }

        return $this->data;
    }
}

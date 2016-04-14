<?php

namespace Admin\Read\Processing;

use Admin\Read\Tables\Table;

class Retriever
{

    /**
     * The Table instance to retrieve from.
     *
     * @var Table
     */
    protected $table;

    /**
     * Return array.
     *
     * End array will look like this:
     *
     * @var array
     */
    protected $return = [];

    /**
     * Retriever constructor.
     *
     * @param Table $table the table to retrieve from.
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Retrieves the data from the table.
     *
     * @return array
     */
    public function retrieve()
    {
        return [
            $this->table->getData(),
            $this->getRelations(),
        ];
    }

    /**
     * Gets the relational data of the table.
     *
     * @return array
     */
    protected function getRelations()
    {
        $relations = [];
        foreach (array_merge($this->table->relations->otm, $this->table->relations->mtm) as $relation) {
            $relations[] = [
                $relation,
                $relation->getData(),
            ];
        }

        return $relations;
    }
}

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
     * @return $this
     */
    public function retrieve()
    {
        $this->return = [];

        return $this;
    }
}

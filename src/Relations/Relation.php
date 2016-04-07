<?php

namespace CRUDL\Relations;

use Closure;
use Exception;

class Relation
{

    /**
     * The primary table to select from.
     *
     * @var string
     */
    public $table;

    /**
     * The columns to select from the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Closures to apply when displaying data.
     *
     * @var array
     */
    protected $closures = [];

    /**
     * Columns containing HTML code.
     *
     * @var array
     */
    protected $noescape = [];

    /**
     * Sets the table of the relation (primary).
     *
     * @param string $table
     *
     * @return $this
     */
    public function table(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Displays a column in the table.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Adds a closure for a field.
     *
     * @param string  $field
     * @param Closure $closure
     *
     * @return $this
     */
    public function closure(string $field, Closure $closure)
    {
        $this->closures[$field] = $closure;

        return $this;
    }

    /**
     * Sets the noescape property array.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function noescape(array $columns)
    {
        $this->noescape = $columns;

        return $this;
    }

    /**
     * Applies closures to an array of data.
     *
     * @param array $data
     *
     * @throws Exception
     *
     * @return array
     */
    protected function applyClosures(array $data)
    {
        foreach ($data as $outer => $item) {
            foreach ($item as $key => $value) {
                if (array_key_exists($key, $this->closures)) {
                    $data[$outer][$key] = call_user_func($this->closures[$key], $value);
                }
            }
        }

        return $data;
    }

    /**
     * Returns an array containing the headers of the columns.
     *
     * @return array
     */
    protected function headers()
    {
        return array_values($this->columns);
    }

    /**
     * Returns an array containing the fields of the columns.
     *
     * @return array
     */
    protected function fields()
    {
        $return = [];
        foreach ($this->columns as $key => $value) {
            $return[] = is_int($key) ? $value : $key;
        }

        return $return;
    }
}
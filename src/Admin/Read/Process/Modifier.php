<?php

namespace Admin\Read\Process;

use Admin\Read\Tables\Table;
use Exception;

class Modifier
{

    /**
     * The table of the modifier to apply to the data passed to modify.
     *
     * @var Table
     */
    protected $table;

    /**
     * Data to perform modifications on.
     *
     * @var array
     */
    protected $data;

    /**
     * Modifier constructor.
     *
     * @param Table $table
     * @param array $data
     */
    public function __construct(Table $table, array $data)
    {
        $this->table = $table;
        $this->data  = $data;
    }

    /**
     * Modifies an array using the
     *
     * @throws Exception if the exception
     *
     * @return array
     */
    public function modify()
    {
        foreach ($this->data as $position => $row) {
            foreach ($row as $key => $value) {
                foreach ($this->table->modifiers->getMap()[$key] ?? [] as $modifier) {
                    if (!is_callable($modifier)) {
                        throw new Exception(sprintf('Modifier could not be applied to row %s.', $key));
                    }
                    $this->data[$position][$key] = $this->call($modifier, $value, $row, $key);
                }
            }
        }

        return $this->data;
    }

    /**
     * Calls a php callable value.
     *
     * @param callable $modifier the callable value to apply to the value of the data.
     * @param mixed    $value    the value to pass to the callable.
     * @param array    $row      the row the the value to pass to the callable.
     * @param string   $key      the key of the value to pass to the callable.
     *
     * @return mixed
     */
    protected function call(callable $modifier, $value, array $row, string $key)
    {
        if (is_string($modifier)) {
            return call_user_func($modifier, $value);
        }

        return call_user_func($modifier, $value, $row, $key);
    }
}
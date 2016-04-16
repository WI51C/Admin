<?php

namespace Admin\Read\Column;

use Closure;

class Transformers
{

    /**
     * Calls of the transformers.
     *
     * @var array
     */
    public $calls = [];

    /**
     * Whether or not the calls array is empty.
     *
     * @var bool
     */
    public $empty = true;

    /**
     * Adds a transformer to the Transformers instance.
     *
     * @param Closure $closure the callable to add.
     *
     * @return $this
     */
    public function add(Closure $closure)
    {
        $this->calls[] = $closure;
        $this->empty   = false;

        return $this;
    }

    /**
     * Gets the content of the td.
     *
     * @param mixed $value    the current value of the row.
     * @param array $row      the current row.
     * @param int   $position the position in the table.
     *
     * @return mixed
     */
    public function getContent($value, array $row, int $position)
    {
        foreach ($this->calls as $call) {
            $value = $call($value, $row, $position);
        }

        return $value;
    }

    /**
     * Gets the call stack of the Transformers instance.
     *
     * @return array
     */
    public function getCalls()
    {
        return $this->calls;
    }

    /**
     * Sets the call stack of the Transformers instance.
     *
     * @param array $calls the array of Closures.
     *
     * @return $this
     */
    public function setCalls($calls)
    {
        $this->calls = $calls;

        return $this;
    }
}

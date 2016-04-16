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
     * Adds a transformer to the Transformers instance.
     *
     * @param Closure $closure the callable to add.
     *
     * @return $this
     */
    public function add(Closure $closure)
    {
        $this->calls[] = $closure;

        return $this;
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

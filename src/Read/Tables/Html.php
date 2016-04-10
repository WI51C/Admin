<?php

namespace Admin\Read\Tables;

class Html
{

    /**
     * The classes to apply to the table html tag.
     *
     * @var array
     */
    public $classes = [];

    /**
     * The ids to apply to the table html tag.
     *
     * @var array
     */
    public $ids = [];

    /**
     * Adds class(es) to the table html tag.
     *
     * @param string $class
     *
     * @return $this
     */
    public function class(string $class)
    {
        $this->classes = array_merge($this->classes, func_get_args());

        return $this;
    }

    /**
     * Adds id(s) to the table html tag.
     *
     * @param string $id
     *
     * @return $this
     */
    public function id(string $id)
    {
        $this->classes = array_merge($this->classes, func_get_args());

        return $this;
    }
}

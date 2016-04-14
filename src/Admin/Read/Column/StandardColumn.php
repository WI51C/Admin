<?php

namespace Admin\Read\Column;

class StandardColumn extends Column
{

    /**
     * Modifier of the column, the <td> value and current row will be passed to the callback.
     *
     * @var callable
     */
    public $modifier;

    /**
     * Gets the content of the <td> tag.
     *
     * @param mixed $value the value to display.
     * @param array $row   the current row.
     *
     * @return mixed
     */
    public function content($value, array $row)
    {
        return $this->modifier ? call_user_func($this->modifier, $value, $row) : $value;
    }

    /**
     * Gets the modifier of the column.
     *
     * @return callable
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * Sets the modifier of the column.
     *
     * @param callable $modifier the callback to set.
     *
     * @return $this
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;

        return $this;
    }
}
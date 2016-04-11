<?php

namespace Admin\Read\Tables;

class Presentation
{

    /**
     * Attributes to add to the table.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Caption of the html table.
     *
     * @var string|null
     */
    protected $caption;

    /**
     * Columns of the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Setting to show the head of the table.
     *
     * @var bool
     */
    protected $head = true;

    /**
     * Adds an attribute to the table.
     *
     * @param string $attribute
     * @param string $value
     *
     * @return $this
     */
    public function attribute(string $attribute, string $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Sets the caption of the table.
     *
     * @param string $caption
     *
     * @return $this
     */
    public function caption(string $caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Sets the columns property of the object.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        foreach ($columns as $column => $alias) {
            $this->columns[is_int($column) ? $alias : $column] = $alias;
        }

        return $this;
    }

    /**
     * Inserts a new column and optionally an alias.
     *
     * @param string      $column
     * @param string|null $alias
     *
     * @return $this
     */
    public function addColumn(string $column, string $alias = null)
    {
        $this->columns[$column] = $alias ?? $column;

        return $this;
    }

    /**
     * Sets whether or not to display the head of the table.
     *
     * @param bool $setting
     *
     * @return $this
     */
    public function head(bool $setting)
    {
        $this->head = $setting;

        return $this;
    }

    /**
     * Gets the attributes of the table tag.
     *
     * @return array
     */
    public function getAttributes()
    {
        $string = '';
        foreach ($this->attributes as $name => $value) {
            $string .= sprintf('%s="%s" ', $name, $value);
        }

        return $string;
    }

    /**
     * Gets the caption to display in the table.
     *
     * @return string|null
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Gets the columns to display in the table.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Gets whether or not to display the head of the table.
     *
     * @return boolean
     */
    public function getHead()
    {
        return $this->head;
    }
}

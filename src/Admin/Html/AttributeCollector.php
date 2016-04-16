<?php

namespace Admin\HTML;

class AttributeCollector
{

    /**
     * Attributes of the html table.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Sets the attributes of the table.
     *
     * @param array $attributes an array of attributes and their value.
     *
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Adds an attribute to the table.
     *
     * @param string $attribute the attribute to add.
     * @param mixed  $value     the value of the attribute.
     *
     * @return $this
     */
    public function addAttribute(string $attribute, $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Gets the attributes array.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Returns the attributes formatted for html. ie. attribute="value" attribute="value" ...
     *
     * @return string
     */
    public function stringifyAttributes()
    {
        return join(' ', array_map(function ($value, string $attribute) {
                           return sprintf('%s="%s"', $attribute, $value);
                       }, $this->attributes, array_keys($this->attributes)) ?? []);
    }
}
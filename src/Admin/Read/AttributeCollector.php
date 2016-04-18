<?php

namespace Admin\Read;

class AttributeCollector
{

    /**
     * Attributes of the collector.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Adds an attribute to the collector.
     *
     * @param string $attributeName  the name of the attribute.
     * @param mixed  $attributeValue the value of the attribute.
     *
     * @return $this
     */
    public function add(string $attributeName, $attributeValue)
    {
        $this->attributes[$attributeName] = $attributeValue;

        return $this;
    }

    /**
     * Converts the attributes to HTML.
     *
     * @return string
     */
    public function __toString()
    {
        return join(' ', array_map(function ($value, $attribute) {
            return sprintf('%s="%s"', $attribute, $value);
        }, $this->attributes, array_keys($this->attributes)));
    }

    /**
     * Gets the attributes of the collector.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the attributes of the collector.
     *
     * @param array $attributes the array of attributes.
     *
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}

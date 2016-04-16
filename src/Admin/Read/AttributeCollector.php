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

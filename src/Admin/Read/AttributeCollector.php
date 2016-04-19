<?php

namespace Admin\Read;

use Admin\Miscellaneous\Collector;

class AttributeCollector extends Collector
{

    /**
     * Converts the attributes to HTML.
     *
     * @return string
     */
    public function __toString()
    {
        return join(' ', array_map(function ($value, $attribute) {
            return sprintf('%s="%s"', $attribute, $value);
        }, $this->array, array_keys($this->array)));
    }

    /**
     * Gets the attributes of the collector.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->array;
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
        $this->array = $attributes;

        return $this;
    }
}

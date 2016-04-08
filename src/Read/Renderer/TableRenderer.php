<?php

namespace Admin\Read\Renderer;

use Exception;

class TableRenderer
{

    /**
     * The template to use to build the table.
     *
     * @var string
     */
    protected $template = '../templates/table.template.php';

    /**
     * Headers to display in the table.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Data to display in the table.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets the template to use in the rendering.
     *
     * @param string $template
     *
     * @throws Exception if the template could not be located.
     *
     * @return $this
     */
    public function template(string $template)
    {
        if (!file_exists($template)) {
            throw new Exception(sprintf('Template %s could not be found.', $template));
        }

        $this->template = $template;

        return $this;
    }

    /**
     * Constructs and returns the html for the table.
     *
     * @return string
     */
    public function render()
    {
        return require($this->template);
    }

    /**
     * Sets the headers of the table.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Sets the data of the table.
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Gets the template of the TableRenderer.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}

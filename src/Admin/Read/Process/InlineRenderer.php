<?php

namespace Admin\Read\Process;

use Exception;

class InlineRenderer extends Renderer
{

    /**
     * Template to load and render.
     *
     * @var string
     */
    protected $inlineTemplate = '../templates/tables/inline.template.php';

    /**
     * Renders the data using the presenter of the table to render.
     *
     * @throws Exception if the template has an invalid filename.
     *
     * @return string
     */
    public function render()
    {
        if (!file_exists($this->template)) {
            throw new Exception(sprintf('Template file %s does not exist.', $this->template));
        }

        ob_start();
        require($this->inlineTemplate);
        require($this->template);

        return ob_get_clean();
    }
}
<?php

namespace Admin\Read;

use Admin\ModuleInterface;

class Read extends Table implements ModuleInterface
{

    /**
     * Renders the read Module.
     *
     * @return string
     */
    public function render()
    {
        return parent::render();
    }
}

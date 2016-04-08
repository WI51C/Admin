<?php

namespace Admin\Modules;

use Admin\ModuleInterface;
use Admin\Read\Table;

class Read extends Table implements Contract
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

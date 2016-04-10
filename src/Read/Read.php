<?php

namespace Admin\Read;

use Admin\ModuleInterface;
use Admin\Read\Renderer\TableRenderer;
use Admin\Read\Tables\Table;

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

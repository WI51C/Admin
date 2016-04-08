<?php

namespace Admin\Modules;

use Admin\ModuleInterface;
use Admin\Table\CustomizableTable;

class Read extends CustomizableTable implements ModuleInterface
{

    /**
     * Returns the content to show on create.
     *
     * @return string
     */
    public function render()
    {
        return 'read';
    }
}

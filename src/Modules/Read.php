<?php

namespace Admin\Modules;

use Admin\ModuleInterface;
use Admin\Table\CustomizableTable;

class Read implements Contract
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

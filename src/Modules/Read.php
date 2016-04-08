<?php

namespace Admin\Modules;

use Admin\ModuleInterface;
use Admin\Read\Table;

class Read extends Table implements Contract
{

    /**
     * Returns the content to show on create.
     *
     * @return string
     */
    function render()
    {
        return 'read';
    }
}

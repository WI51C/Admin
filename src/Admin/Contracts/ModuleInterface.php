<?php

namespace Admin\Contracts;

interface ModuleInterface
{

    /**
     * Renders the module.
     *
     * @return string
     */
    public function render();
}

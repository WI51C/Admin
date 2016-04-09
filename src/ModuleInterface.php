<?php

namespace Admin;

interface ModuleInterface
{

    /**
     * Renders the module.
     *
     * @return string
     */
    public function render();
}
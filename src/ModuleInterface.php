<?php

namespace CRUDL;

interface ModuleInterface
{

    /**
     * Renders the module; returns the html.
     *
     * @return mixed
     */
    public function render();
}
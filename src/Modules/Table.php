<?php

namespace CRUDL\Modules;

use CRUDL\ModuleInterface;
use CRUDL\Relations\TabularRelation;
use MysqliDb;

class Table extends TabularRelation implements ModuleInterface
{

    /**
     * Database connection instance.
     *
     * @var MysqliDb
     */
    protected $controller;

    /**
     * Returns the content to show on create.
     *
     * @return string
     */
    public function render()
    {
        $data = $this->map->getRelationData();

        var_dump($data);
    }
}

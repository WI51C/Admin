<?php

namespace CRUDL\Modules;

use CRUDL\ModuleInterface;
use MysqliDb;

class Update implements ModuleInterface
{

    /**
     * Database connection instance.
     *
     * @var MysqliDb
     */
    protected $connection;

    /**
     * Sets the connection of the module.
     *
     * @param MysqliDb $connection
     *
     * @return $this
     */
    public function setConnection(MysqliDb $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Returns the content to show on create.
     *
     * @return string
     */
    public function render()
    {
        return 'update';
    }
}

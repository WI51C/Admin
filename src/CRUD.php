<?php

namespace Admin;

use Admin\Modules\Create;
use Admin\Modules\Delete;
use Admin\Modules\Read;
use Admin\Modules\Update;
use Exception;
use MysqliDb;

class CRUD
{
    /**
     * Modules of the CRUD.
     *
     * @var array
     */
    protected $modules;

    /**
     * Instance of Create for inserting data into a database.
     *
     * @var Create
     */
    public $create;

    /**
     * Instance of Create for reading data from a database.
     *
     * @var Read
     */
    public $read;

    /**
     * Instance of Create for updating data in a database.
     *
     * @var Update
     */
    public $update;

    /**
     * Instance of Create for deleting data from a database.
     *
     * @var Delete
     */
    public $delete;

    /**
     * Mysqli database connection.
     *
     * @var MysqliDb
     */
    public $connection;

    /**
     * Hostname of the database connection.
     *
     * @var string
     */
    public $hostname;

    /**
     * Username to the database connection.
     *
     * @var string
     */
    public $username;

    /**
     * Password to the database connection.
     *
     * @var string
     */
    public $password;

    /**
     * The database to perform actions upon.
     *
     * @var string
     */
    public $database;

    /**
     * The table of the CRUD.
     *
     * @var string
     */
    public $table;

    /**
     * CRUDL constructor.
     *
     * Creates CRUDElements of the CRUDL instance.
     *
     * @param string $hostname the hostname of the database connection.
     * @param string $username the username of the database connection.
     * @param string $password the password of the database connection.
     * @param string $database the database of the database connection.
     * @param string $table    the table of the CRUD.
     */
    public function __construct(string $hostname, string $username, string $password, string $database, string $table)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new MysqliDb($hostname, $username, $password, $database);

        $this->table  = $table;
        $this->create = new Create($this);
        $this->read   = new Read($this);
        $this->update = new Update($this);
        $this->delete = new Delete($this);
    }

    /**
     * Returns the HTML of the module.
     *
     * @param string $action
     *
     * @throws Exception
     *
     * @return string
     */
    public function action(string $action = 'read')
    {
        if (!in_array($action, ['read', 'delete', 'update', 'create'])) {
            throw new Exception(sprintf('Action %s is invalid. Valid actions are create, read, update and delete.'));
        }

        return $this->{$action}->render();
    }
}

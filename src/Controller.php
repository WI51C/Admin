<?php

namespace CRUDL;

use CRUDL\Modules\Create;
use CRUDL\Modules\Delete;
use CRUDL\Modules\Read;
use CRUDL\Modules\Table;
use CRUDL\Modules\Update;
use Exception;
use MysqliDb;

class Controller
{

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
     * Instance of Create for listing data from a database.
     *
     * @var Table
     */
    public $table;

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
     * CRUDL constructor.
     *
     * Creates CRUDElements of the CRUDL instance.
     *
     * @param string $hostname the hostname of the database connection.
     * @param string $username the username of the database connection.
     * @param string $password the password of the database connection.
     * @param string $database the database of the database connection.
     */
    public function __construct(string $hostname, string $username, string $password, string $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new MysqliDb($hostname, $username, $password, $database);

        $this->create = new Create($this);
        $this->read   = new Read($this);
        $this->update = new Update($this);
        $this->delete = new Delete($this);
        $this->table  = new Table($this);
    }

    /**
     * Routes the action to take in the CRUDL instance.
     *
     * @param string $action the action to perform:
     *                       - create
     *                       - read
     *                       - update
     *                       - delete
     *                       - list
     *
     * @throws Exception
     */
    public function action(string $action)
    {
        $allowed = ['create', 'read', 'update', 'delete', 'table'];
        if (!in_array($action = trim(strtolower($action)), $allowed)) {
            throw new Exception(sprintf('Unknown action %s.', $action));
        }

        echo $this->{$action}->render();
    }
}
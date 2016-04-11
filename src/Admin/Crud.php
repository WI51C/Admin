<?php

namespace Admin;

use Admin\Read\Read;
use MysqliDb;

class Crud
{

    /**
     * Instance of Read for displaying tabular data.
     *
     * @var $this
     */
    public $read;

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
     * @param string $table    the table of the CRUD.
     */
    public function __construct(string $hostname, string $username, string $password, string $database, string $table)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new MysqliDb($hostname, $username, $password, $database);

        $this->read = new Read($this);
        $this->read->database->table($table);
    }

    /**
     * Clones the connection of the Crud instance.
     *
     * @return MysqliDb
     */
    public function query()
    {
        return clone $this->connection;
    }
}

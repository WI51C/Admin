<?php

namespace Admin;

use MysqliDb;

class Connection
{

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
     * ConnectionL constructor.
     *
     * Creates ConnectionElements of the ConnectionL instance.
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
    }

    /**
     * Clones the connection of the Connection instance.
     *
     * @return MysqliDb
     */
    public function query()
    {
        return clone $this->connection;
    }
}

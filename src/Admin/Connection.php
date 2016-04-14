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
    protected $connection;

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
     * Sets the new connection using the properties of the Connection instance.
     *
     * @return $this
     */
    public function connect()
    {
        $this->connection = new MysqliDb($this->hostname, $this->username, $this->password, $this->database);

        return $this;
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

    /**
     * Gets the hostname of the connection.
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Sets the hostname of the connection.
     *
     * @param string $hostname the hostname to set.
     *
     * @return $this
     */
    public function setHostname(string $hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username of the of the connection.
     *
     * @param string $username the username to set.
     *
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Gets the password of the connection.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password of the connection
     *
     * @param string $password the password to set.
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the database name of the connection.
     *
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Sets the database name of the connection.
     *
     * @param string $database the name to set.
     *
     * @return $this
     */
    public function setDatabase(string $database)
    {
        $this->database = $database;

        return $this;
    }
}

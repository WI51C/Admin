<?php

namespace Admin;

class Panel
{

    /**
     * The connection of the Panel.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * Creates a new Panel object.
     *
     * @param string $hostname the hostname of the database server.
     * @param string $username the username to use for the database.
     * @param string $password the password to use for the database.
     * @param string $database the database to use.
     *
     * @return Panel
     */
    public function __construct(string $hostname, string $username, string $password, string $database)
    {
        $this->connection = new Connection($hostname, $username, $password, $database);
    }

    /**
     * Creates a new Panel object.
     *
     * @param string $hostname the hostname of the database server.
     * @param string $username the username to use for the database.
     * @param string $password the password to use for the database.
     * @param string $database the database to use.
     *
     * @return Panel
     */
    public static function new(string $hostname, string $username, string $password, string $database)
    {
        return new static($hostname, $username, $password, $database);
    }
}
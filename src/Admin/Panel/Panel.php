<?php

namespace Admin\Panel;

use Symfony\Component\HttpFoundation\Request;

class Panel
{

    /**
     * Connection of the panel.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * Request information.
     *
     * @var Request
     */
    protected $request;

    /**
     * Panel constructor.
     *
     * @param string $hostname the hostname of the database.
     * @param string $username the username of the login to the database.
     * @param string $password the password of the login to the database.
     * @param string $database the name of the database to connect to.
     */
    public function __construct(string $hostname, string $username, string $password, string $database)
    {
        $this->connection = new Connection($hostname, $username, $password, $database);
        $this->request    = Request::createFromGlobals();
    }

    /**
     * Gets the connection instance of the panel.
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Sets the connection instance of the panel.
     *
     * @param Connection $connection the instance to set.
     *
     * @return Panel
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Gets the request instance of the Panel.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the instance of Request of the Panel.
     *
     * @param Request $request the instance to set.
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
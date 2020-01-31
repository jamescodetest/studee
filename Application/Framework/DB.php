<?php
namespace Application\Framework;

class DB
{
    private $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    public function connect()
    {
        $connstr = sprintf("%s:host=%s;dbname=%s;charset=utf8", $_dbServer, $_dbHost, $_dbName);
        $this->connection = new \PDO($connstr, $_dbUname, $_dbPass);
        if (PROJECT_MODE == PROJECT_MODE_DEBUG) {
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        }
    }

    public function execute(string $_sql, array $_parameters = [])
    {
        if ($_sql == '') {
            return false;
        }

        $statement = $this->connection->prepare($_sql);
        $result = $statement->execute($_parameters);

        return $statement;
    }

    public function getAll(string $_sql, array $_parameters = []): array
    {
        $statement = $this->execute($_sql, $_parameters);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRow(string $_sql, array $_parameters = []): array
    {
        $statement = $this->execute($_sql, $_parameters);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }
}

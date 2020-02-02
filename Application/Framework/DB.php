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
        $connstr = sprintf("%s:host=%s;dbname=%s;port:3306;charset=utf8", 'mysql', 'mysql', 'dbtest');
        $this->connection = new \PDO($connstr, 'otherUser', 'password');
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
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

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function getIdentity()
    {
        return $this->connection->lastInsertId();
    }
}

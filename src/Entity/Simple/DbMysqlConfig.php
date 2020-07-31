<?php

declare(strict_types=1);

namespace src\Entity\Simple;

class DbMysqlConfig
{
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPswd;
    
    public function getDbHost()
    {
        return $this->dbHost;
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getDbUser()
    {
        return $this->dbUser;
    }

    public function getDbPswd()
    {
        return $this->dbPswd;
    }

    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }

    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    public function setDbPswd($dbPswd)
    {
        $this->dbPswd = $dbPswd;
    }
}

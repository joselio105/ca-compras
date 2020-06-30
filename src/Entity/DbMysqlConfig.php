<?php

declare(strict_types=1);

namespace src\Entity;

class DbMysqlConfig implements EntityInterface
{
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPswd;
    
    public function getDbHost(){
        return $this->dbHost;
    }
    
    public function getDbName(){
        return $this->dbName;
    }
    
    public function getDbUser(){
        return $this->dbUser;
    }
    
    public function getDbPswd(){
        return $this->dbPswd;
    }
    
    public function setDbHost(string $dbHost){
        $this->dbHost = $dbHost;
    }
    
    public function setDbName(string $dbName){
        $this->dbName = $dbName;
    }
    
    public function setDbUser(string $dbUser){
        $this->dbUser = $dbUser;
    }
    
    public function setDbPswd(string $dbPswd){
        $this->dbPswd = $dbPswd;
    }
}


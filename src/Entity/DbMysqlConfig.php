<?php

declare(strict_types=1);

namespace src\Entity;

require_once 'src/Entity/Entity.php';

class DbMysqlConfig extends Entity
{
    public $dbHost;
    public $dbName;
    public $dbUser;
    public $dbPswd;
    
    public function getTableName()
    {
        return null;
    }


}

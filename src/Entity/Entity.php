<?php

declare(strict_types=1);

namespace src\Entity;

require_once 'src/Entity/EntityInterface.php';

abstract class Entity implements EntityInterface
{

    public function __get($field)
    {
        return $this->$field;
    }

    public function __set($field, $value)
    {
        $this->$field = $value;
    }
    
    public function getFields()
    {
        $api = new \ReflectionClass($this);
        foreach($api->getProperties(\ReflectionProperty::IS_PUBLIC) as $property)
        {
            $fields[] = $property->name;
        }
        
        return $fields;
    }

    abstract public function getTableName();

}


<?php
namespace src\Entity;

interface EntityInterface
{
    public function __get(string $field);
    
    public function __set(string $field, $value);
    
    public function getTableName();
    
    public function getFields();
}


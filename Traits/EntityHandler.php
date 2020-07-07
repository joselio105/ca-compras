<?php
namespace Traits;

use src\Entity\EntityInterface;

trait EntityHandler
{
    public function getProperties(EntityInterface $entity)
    {
        $properties = array();
        
        $api = new \ReflectionClass($entity);
        foreach($api->getProperties(\ReflectionProperty::IS_PRIVATE) as $property)
        {
            $properties[] = $property->name;
        }
        
        return $properties;
    }
    
    public function setProperty(EntityInterface $entity, string $property, $value)
    {
        $setFunction = "set".ucfirst($property);
        $function = $setFunction;
        $entity->$function($value);
    }
    
    public function getProperty(EntityInterface $entity, string $property)
    {
        $function = "get".ucfirst($property);
        return $entity->$function();
    }
}


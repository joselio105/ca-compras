<?php
namespace Traits;

use src\Entity\EntityInterface;
use src\Entity\Extended\EmbalagemExtended;

trait EntityHandlerTrait
{
    /**
     * Lista um array com as propriedades de uma classe Entity
     * @param EntityInterface $entity
     * @return string[]
     */
    public function getProperties(EntityInterface $entity)
    {
        $classAttrs = $this->getClassAttrs($entity);
        
        if(key_exists('parentClassName', $classAttrs))
        {
            foreach ($classAttrs['properties'] as $property)
            {
                array_push($classAttrs['parentProperties'], $property);
                $classAttrs['properties'] = $classAttrs['parentProperties'];
            }
        } 
        
        return $classAttrs['properties'];
    }
    
    /**
     * Seta o valor de uma determinada propriedade
     * @param EntityInterface $entity
     * @param string $property
     * @param mixed $value
     */
    public function setProperty(EntityInterface $entity, string $property, $value)
    {
        /*
         * No caso de uma Entidade Simples vefificar se existe o método e executar
         * No caso de uma Entidade Extendida:
         *  - Verificar as Propriedades do ParentClass
         *  - Verificar as Propriedades de cada Classe Propriedade
         */
        $setFunction = "set".ucfirst($property);
        $entity->$setFunction($value);
    }
    
    /**
     * Seta o valor de todas as propriedades de uma entity
     * @param EntityInterface $entity
     * @param object $values
     */
    public function setProperties(EntityInterface $entity, array $values)
    {
        $properties = $this->getProperties($entity);
        var_dump($this->getClassAttrs($entity));die;
        foreach ($values as $id=>$value)
        {
            $this->setProperty($entity, $properties[$id], $value);
        }
    }
    
    /**
     * Recupera o valor de uma determinada propriedade da classe 
     * @param EntityInterface $entity
     * @param string $property
     * @return mixed
     */
    public function getProperty(EntityInterface $entity, string $property)
    {
        $function = "get".ucfirst($property);
        return $entity->$function();
    }
    
    /**
     * Recupera o nome da tabela do banco de dados relativa à classe
     * @param EntityInterface $entity
     * @return string
     */
    public function getTableName(EntityInterface $entity)
    {
        $classAttrs = $this->getClassAttrs($entity);
        if(key_exists('parentClassName', $classAttrs))
            $className = substr($classAttrs['parentClassName'], strlen($classAttrs['parentClassNamespace'])+1);
        else 
            $className = $classAttrs['className'];
        
        $className = str_replace('T', '_t', $className);
        
        return strtolower($className);
    }
    
    public function getClassAttrs(EntityInterface $entity)
    {
        $api = new \ReflectionClass($entity);
        $classAttrs = array(
            'api'=>$api,
            'namespace'=>$api->getNamespaceName(),
            'className'=>substr($api->getName(), strlen($api->getNamespaceName())+1)
        );
        
        foreach($api->getProperties(\ReflectionProperty::IS_PRIVATE) as $property)
        {
            $classAttrs['properties'][] = $property->name;
        }
        
        foreach ($api->getMethods(\ReflectionProperty::IS_PUBLIC) as $method)
        {
            $classAttrs['methods'][] = $method->name;
        }
        
        $classAttrs = $this->getParentClassAttrs($classAttrs);
        unset($classAttrs['api']);
        
        return $classAttrs;
    }
    
    private function getParentClassAttrs(array $classAttrs)
    {
        $parentClass = $classAttrs['api']->getParentClass();
        if($parentClass)
        {
            $parts = explode('\\', $parentClass->name);
            $lenght = strlen($parts[count($parts)-1]) + 1;
            $classAttrs['parentClassName'] = $parentClass->name;
            $classAttrs['parentClassNamespace'] = substr($parentClass->name, 0, -1*$lenght);
            $classAttrs['parentProperties'] = $this->getParentClassProperties($classAttrs['parentClassName']);
            $classAttrs['parentMethods'] = $this->getParentClassMethods($classAttrs['parentClassName']);
        }
        
        return $classAttrs;
    }
    
    private function getParentClassProperties(string $className)
    {
        $properties = array();
        
        $api = new \ReflectionClass($className);
        foreach ($api->getProperties(\ReflectionProperty::IS_PRIVATE) as $property)
            $properties[] = $property->name;
        
        return $properties;
    }
    
    private function getParentClassMethods(string $className)
    {
        $methods = array();
        
        $api = new \ReflectionClass($className);
        foreach ($api->getMethods(\ReflectionProperty::IS_PUBLIC) as $property)
            $methods[] = $property->name;
            
        return $methods;
    }
}


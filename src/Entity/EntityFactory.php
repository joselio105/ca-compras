<?php

declare(strict_types=1);

namespace src\Entity;

require_once 'src/Entity/EntityInterface.php';

class EntityFactory implements EntityInterface
{
    private $entityClassName;
    private $entityObject;
    private $entityNamespace;
    private $reflectionClass;
    private $atributes;
    private $atributesNoRequired;
    private $atributesUnique;
    private $methods;
    private $primaryKey;

    public function __construct($entity)
    {
        $this->primaryKey = "id";
        $this->atributesNoRequired = [$this->primaryKey];
        $this->atributesUnique = [$this->primaryKey];
        
        $this->entityObject = $entity;
        $this->reflectionClass = new \ReflectionClass($this->entityObject);
        $this->entityClassName = $this->reflectionClass->getName();
        $this->entityNamespace = $this->reflectionClass->getNamespaceName();
        $this->setAtributes();
        $this->setMethods();
        $this->validate();
    }
    
    public function getEntityClassName()
    {
        return $this->entityClassName;
    }
    
    public function getEntityNamespace()
    {
        return $this->entityNamespace;
    }
    
    public function getEntityObject()
    {
        return $this->entityObject;
    }
    
    public function getAtributes()
    {
        return $this->atributes;
    }

    public function getAtributesValues()
    {
        $values = [];
        
        foreach ($this->atributes as $atributeName)
        {
            $values[$atributeName] = $this->getAtributeValue($atributeName);
        }
        
        return $values;
    }

    public function getAtributeValue(string $atributeName)
    {
        $function = "get".ucfirst($atributeName);
        return $this->entityObject->$function();
    }

    public function getTableName()
    {
        $className = str_replace('T', '_t', $this->reflectionClass->getShortName());        
        return strtolower($className);
    }

    public function setAtributesValues(array $values)
    {
        foreach ($values as $key=>$value)
        {
            $atributeName = $this->atributes[$key];
            $this->setAtributeValue($atributeName, $value);
        }
    }
    
    public function setAtributeValue(string $atributeName, $value)
    {
        $function = 'set'.ucfirst($atributeName);
        $this->entityObject->$function($value);
    }
    
    public function getAtributesNoRequired()
    {
        return $this->atributesNoRequired;
    }
    
    public function setAtributesNoRequired(array $atributes)
    {
        foreach ($atributes as $attr)
        {
            $key = count($this->atributesNoRequired);
            $this->atributesNoRequired[$key] = $attr;
        }
    }
    
    public function getAtributesUnique()
    {
        return $this->atributesUnique;
    }
    
    public function setAtributesUnique(array $atributes)
    {
        foreach ($atributes as $attr)
        {
            $key = count($this->atributesUnique);
            $this->atributesUnique[$key] = $attr;
        }
    }
    
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    private function setAtributes()
    {
        $this->atributes = [];
        
        foreach ($this->reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE) as $atribute)
            $this->atributes[] = $atribute->name;
    }
    
    private function setMethods()
    {
        $this->methods = [];
        
        foreach ($this->reflectionClass->getMethods(\ReflectionProperty::IS_PUBLIC) as $method)
            $this->methods[] = $method->name;
    }
    
    private function validate() 
    {
        $this->checkIsObject();
        $this->checkAtributes();
        $this->checkMethods();
        $this->checkAtributesNoRequired();
    }
    
    private function checkIsObject()
    {
        if(is_object($this->entityObject) == false)
            throw new \Exception("FALHA: [{$this->entityClassName}] Informação não corresponde a um objeto");
    }
    
    private function checkAtributes()
    {
        if(empty($this->atributes))
            throw new \Exception("FALHA: [{$this->entityClassName}] Classe sem atributos");
    }
    
    private function checkMethods()
    {
        foreach ($this->atributes as $atribute)
        {
            $this->checkMethod($atribute);
        }
    }
    
    private function checkMethod(string $atribute)
    {
        foreach (array('get', 'set') as $functioPrefix)
        {
            $atribute = ucfirst($atribute);
            $functionName = "{$functioPrefix}{$atribute}";
            
            if(in_array($functionName, $this->methods) === false)
                throw new \Exception("FALHA: [{$this->entityClassName}] Classe sem o método {$functionName}");
        }
    }
    
    private function checkAtributesNoRequired()
    {
        foreach ($this->getAtributesNoRequired() as $attr)
        {
            if(in_array($attr, $this->getAtributes()) === false AND $attr != "id")
                throw new \Exception("FALHA [{$attr}] Atributo indicado como não obrigatório não é um dos atributos da classe {$this->getEntityClassName()}");
        }
    }

}

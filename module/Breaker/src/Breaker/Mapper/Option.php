<?php
namespace Breaker\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Breaker\Entity\OptionInterface as OptionEntityInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Option extends AbstractDbMapper implements OptionInterface
{
    protected $tableName  = 'options';

    public function findById($id)
    {
        $select = $this->getSelect()
                       ->where(array('idoption' => $id));

        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function getTableName(){
        return $this->tableName;
    }
    
    public function setTableName($tableName){
        $this->tableName=$tableName;
    }    
    
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());
        return $result;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'idoption = ' . $entity->getId();
        }

        return parent::update($entity, $where, $tableName, $hydrator);
    }
    
    public function delete($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
    	if (!$where) {
    		$where = 'idoption = ' . $entity->getId();
    	}
    
    	return parent::delete($entity, $where, $tableName, $hydrator);
    }
    
	public function fetchAll() {
		return $this->getSelect();
	}

}

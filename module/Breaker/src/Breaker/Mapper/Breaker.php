<?php

namespace Breaker\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Paginator;
use Breaker\Entity\BreakerInterface as BreakerEntityInterface;

class Breaker extends AbstractDbMapper implements BreakerInterface
{

	/**
	 * @var string
	 */
	protected $tableName  = 'table_name';
    
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
    	$result = parent::insert($entity, $tableName, $hydrator);
    	$entity->setId($result->getGeneratedValue());
    	return $result;
    }
    
    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
    	if (!$where) {
    		$where = 'id = ' . $entity->getId();
    	}
    
    	return parent::update($entity, $where, $tableName, $hydrator);
    }
    
//     public function saveProject(Project $project)
//     {
//     	$data = array(
//     			'title' 				=> $project->title,
//     			'description'  			=> $project->description,
//     			'created'  				=> $project->created,
//     			'owner'  				=> $project->owner,
//     			'project_state_id'  	=> $project->state,
//     	);
    
//     	$id = (int)$user->id;
//     	if ($id == 0)
//     	{
//     		$debug = new \Elemental\Model\Debug ($this->tableGateway);
//     		$debug->showSql($data);
//     		//             $this->insert($data);					// Comment for debug
//     	} else {
//     		if ($this->getProject($id)) {
//     			$this->update($data, array('iduser' => $id));
//     		} else {
//     			throw new \Exception('Form id does not exist');
//     		}
//     	}
//     }
    
    public function getProject($id)
    {
    	$id  = (int) $id;
    	$rowset = $this->tableGateway->select(array('id' => $id));
    	$row = $rowset->current();
    	if (!$row) {
    		throw new \Exception("Could not find row $id");
    	}
    	return $row;
    }
    
    
    public function findAll()
    {
    	$select = $this->getSelect($this->tableName);
    	//$select->order(array('username ASC', 'display_name ASC', 'email ASC'));
    	$resultSet = $this->select($select);
    
    	$resultSet = new HydratingResultSet($this->getHydrator(), $this->getEntityPrototype());
    	$adapter = new Paginator\Adapter\DbSelect($select, $this->getSlaveSql(), $resultSet);
    	$paginator = new Paginator\Paginator($adapter);
    
    	return $paginator;
    }    
    
    public function fetchAll()
    {
    	$select = $this->getSelect();
        $entity = $this->select($select);    
        
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }
             
    public function fetchPair()
    {
    	$resultSet = $this->select();    	
    	foreach ($resultSet->toArray() as $key=>$value)
    		$pair[$value['project_state_id']]=$value['project_state'];
    	return $pair;
    }
        
    public function findById($id)
    {
    	$select = $this->getSelect()
    					->where(array('id' => $id));
    	$entity = $this->select($select)->current();
    	$this->getEventManager()->trigger('find', $this, array('entity' => $entity));
    	return $this->getHydrator()->extract($entity);
    }
    
    public function fetchById($id)
    {
    	$select = $this->getSelect()
    					->where(array('id' => $id));
    	$entity = $this->select($select)->current();	
    	$this->getEventManager()->trigger('find', $this, array('entity' => $entity));
    	return $entity;
    }
    
    public function findByProjectname($project)
    {
    	$select = $this->getSelect()
    					->where(array('name' => $project));
    	$entity = $this->select($select)->current();
    	$this->getEventManager()->trigger('find', $this, array('entity' => $entity));
    	return $entity;
    }    
    
    public function remove($entity)
    {
    	$id = $entity->getId();
    	$this->delete(array('id' => $id));
    	$this->getEventManager()->trigger('remove', $this, array('entity' => $entity));
    	return $id;
    }
	/* (non-PHPdoc)
	 * @see \Breaker\Mapper\BreakerInterface::findByProducer()
	 */
	public function findByProducer($id) {
		// TODO Auto-generated method stub
		
	}

    
//     public function getTableName(){
//     	return $this->tableName;
//     }
    
//     public function setTableName($tableName){
//     	$this->tableName=$tableName;
//     }
}
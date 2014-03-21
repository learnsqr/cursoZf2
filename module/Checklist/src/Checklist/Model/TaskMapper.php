<?php
namespace Checklist\Model;

use Zend\Db\Adapter\Adapter;
use Checklist\Model\TaskEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class TaskMapper
{
    protected $tableName = 'task_item';
    protected $dbAdapter;
    protected $sql;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }

    public function fetchAll()
    {
        $select = $this->sql->select();
        $select->order(array('completed ASC', 'created ASC'));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new TaskEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveTask(TaskEntity $task)
    {
    	$hydrator = new ClassMethods();
    	$data = $hydrator->extract($task);
    
    	if ($task->getId()) {
    		// update action
    		$action = $this->sql->update();
    		$action->set($data);
    		$action->where(array('id' => $task->getId()));
    	} else {
    		// insert action
    		$action = $this->sql->insert();
    		unset($data['id']);
    		$action->values($data);
    	}
    	$statement = $this->sql->prepareStatementForSqlObject($action);
    	$result = $statement->execute();
    
    	if (!$task->getId()) {
    		$task->setId($result->getGeneratedValue());
    	}
    	return $result;
    
    }
    
    public function getTask($id)
    {
    	$select = $this->sql->select();
    	$select->where(array('id' => $id));
    
    	$statement = $this->sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute()->current();
    	if (!$result) {
    		return null;
    	}
    
    	$hydrator = new ClassMethods();
    	$task = new TaskEntity();
    	$hydrator->hydrate($result, $task);
    
    	return $task;
    }
    
    public function deleteTask($id)
    {
    	$delete = $this->sql->delete();
    	$delete->where(array('id' => $id));
    
    	$statement = $this->sql->prepareStatementForSqlObject($delete);
    	return $statement->execute();
    }
}
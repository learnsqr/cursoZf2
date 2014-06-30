<?php
namespace Album\Model;

use Zend\Db\Adapter\Adapter;
use Checklist\Model\TaskEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class AlbumMapper
{
//     protected $tableName = 'task_item';
//     protected $dbAdapter;
//     protected $sql;
	
    protected $adapterMaster;
    protected $adapterSlave;
    
    protected static $endpointHost = 'http://cursozf2.local';
    protected static $endpointAlbums = '/albums';
    protected static $endpointAlbumsData = '/albums/%s';
    
    public function __construct(AdapterInterface $adapterMaster, AdapterInterface $adapterSlave)
    {
    	$this->adapterMaster = $adapterMaster;
    	$this->adapterSlave = $adapterSlave;
    }
    
    public function __construct2(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }
	
    
    
    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
    	$url = self::$endpointHost . sprintf(self::$endpointAlbums);
    	$albums = self::doRequest($url);
    	$model = new ViewModel(array("albums" => $albums->_embedded->album));
    	return $model;
    }
    
    
    public function fetchAllAPI($filter)
    {
    	$url = self::$endpointHost . sprintf(self::$endpointAlbums);
    	$albums = self::doRequest($url);
    	$model = new ViewModel(array("albums" => $albums->_embedded->album));
    	return $model;
    }
    
    public function fetchAll2($filter)
    {
    	$select = new Select('album');
    	if (isset($filter['title'])) {
    		$select->where(array('title LIKE ?' => '%'.$filter['title'].'%'));
    	}
    
    	$resultset = new HydratingResultSet;
    	$resultset->setObjectPrototype(new AlbumEntity);
    
    	$paginatorAdapter = new DbSelect(
    			$select,
    			$this->adapterSlave,
    			$resultset
    	);
    
    	$collection = new AlbumCollection($paginatorAdapter);
    	return $collection;
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
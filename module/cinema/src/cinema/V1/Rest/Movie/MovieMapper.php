<?php 
namespace cinema\V1\Rest\Movie; 

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select; 
use Zend\Db\Adapter\AdapterInterface; 
use Zend\Paginator\Adapter\DbSelect; 
use Zend\Db\ResultSet\HydratingResultSet;

class MovieMapper 
{
    protected $adapterMaster;
    protected $adapterSlave;
    protected $tableName = 'movie';
    protected $sqlWrite;
    protected $sqlRead;
    
    public function __construct(AdapterInterface $adapterMaster, AdapterInterface $adapterSlave)
    {
        $this->adapterMaster = $adapterMaster;
        $this->adapterSlave = $adapterSlave;
        $this->sqlWrite = new Sql($adapterMaster);
        $this->sqlRead = new Sql($adapterSlave);
        $this->sqlWrite->setTable($this->tableName);
        $this->sqlRead->setTable($this->tableName);
    }
    
    public function fetchAllWithoutFilter()
    {
        $select = new Select('movie');
        $paginatorAdapter = new DbSelect($select, $this->adapterSlave);
        $collection = new MovieCollection($paginatorAdapter);
        return $collection;
    }
    
    public function fetchAll($filter)
    {
    	$select = new Select('movie');
    	if (isset($filter['title'])) {
    		$select->where(array('title LIKE ?' => '%'.$filter['title'].'%'));
    	}
    	 
    	$resultset = new HydratingResultSet;
    	$resultset->setObjectPrototype(new MovieEntity);
    
    	$paginatorAdapter = new DbSelect(
    			$select,
    			$this->adapterSlave,
    			$resultset
    	);
    
    	$collection = new MovieCollection($paginatorAdapter);
    	return $collection;
    }

    public function fetchOne($albumId)
    {
        $sql = 'SELECT * FROM movie WHERE idmovie = ?';
        $resultset = $this->adapterSlave->query($sql, array($albumId));
        $data = $resultset->toArray();
        if (!$data) {
            return false;
        }

        $entity = new MovieEntity();
        $entity->populate($data[0]);        
        return $entity;
    }
    
    public function save($data, $id = 0)
    {
    	$data = (array)$data;
    	if ($id > 0) {
    		$data['id'] = $id;
    	}
    
    	if (isset($data['id'])) {
    		$sql = 'UPDATE movie SET movie = :movie WHERE idmovie = :idmovie';
    		$result = $this->adapterMaster->query($sql, $data);
    	} else {
    		$sql = 'INSERT INTO movie (movie) VALUES(:name)';
    		$result = $this->adapterMaster->query($sql, $data);
    
    		$data['idmovie']= $this->adapterMaster->getDriver()->getLastGeneratedValue();
    
    	}
    	$entity = new MovieEntity();
    	$entity->populate($data);
    	return $entity;
    }
    
    public function delete($id)
    {
    	$delete = $this->sqlWrite->delete();
    	$delete->where(array('id' => $id));
    	
    	$statement = $this->sqlWrite->prepareStatementForSqlObject($delete);
    	$statement->execute();
    	return true;
    }
    
    
}

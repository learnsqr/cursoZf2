<?php 
namespace Music\V1\Rest\Album; 

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select; 
use Zend\Db\Adapter\AdapterInterface; 
use Zend\Paginator\Adapter\DbSelect; 
use Zend\Db\ResultSet\HydratingResultSet;

class AlbumMapper 
{
    protected $adapterMaster;
    protected $adapterSlave;
    protected $tableName = 'album';
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
        $select = new Select('album');
        $paginatorAdapter = new DbSelect($select, $this->adapterSlave);
        $collection = new AlbumCollection($paginatorAdapter);
        return $collection;
    }
    
    public function fetchAll($filter)
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

    public function fetchOne($albumId)
    {
        $sql = 'SELECT * FROM album WHERE id = ?';
        $resultset = $this->adapterSlave->query($sql, array($albumId));
        $data = $resultset->toArray();
        if (!$data) {
            return false;
        }

        $entity = new AlbumEntity();
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
    		$sql = 'UPDATE album SET title = :title, artist = :artist WHERE id = :id';
    		$result = $this->adapterMaster->query($sql, $data);
    	} else {
    		$sql = 'INSERT INTO album (title, artist) VALUES(:title, :artist)';
    		$result = $this->adapterMaster->query($sql, $data);
    
    		$data['id']= $this->adapterMaster->getDriver()->getLastGeneratedValue();
    
    	}
    	$entity = new AlbumEntity();
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

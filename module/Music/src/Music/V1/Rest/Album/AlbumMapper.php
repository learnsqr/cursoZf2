<?php 
namespace Music\V1\Rest\Album; 

use Zend\Db\Sql\Select; 
use Zend\Db\Adapter\AdapterInterface; 
use Zend\Paginator\Adapter\DbSelect; 

class AlbumMapper 
{
    protected $adapterMaster;
    protected $adapterSlave;
    
    public function __construct(AdapterInterface $adapterMaster, AdapterInterface $adapterSlave)
    {
        $this->adapterMaster = $adapterMaster;
        $this->adapterSlave = $adapterSlave;
    }

    public function fetchAll()
    {
        $select = new Select('album');
        $paginatorAdapter = new DbSelect($select, $this->adapterSlave);
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
        $entity->id 	= $data[0]['id'];
        $entity->artist  	= $data[0]['artist'];
        $entity->title   	= $data[0]['title'];
        return $entity;
    }
}

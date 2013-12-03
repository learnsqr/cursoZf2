<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Album\Model\Album;

class AlbumRestController extends AbstractRestfulController
{
    
    protected $albumTable;
    
    public function get($id) {
        return new JsonModel(array("album" => $this->getAlbumTable()->getAlbum($id)));
    }
    
    public function getList() {
        $albums = $this->getAlbumTable()->fetchAll();
        $data = array();
        foreach ($albums as $album)
        	$data[] = $album;
        
        return new JsonModel(array(
    		'albums' => $data,
        ));
    }
    
    public function update($id, $data) {
        $album = $this->getAlbumTable()->getAlbum($id);
        foreach ($data as $key => $value) {
            $album->$key = $value;
        }
        $this->getAlbumTable()->saveAlbum($album);
        return new JsonModel(array("status" => "ok"));
    }
    
    function create($data) {
        $album = new Album();
        $album->exchangeArray($data);
        $this->getAlbumTable()->saveAlbum($album);
        return new JsonModel(array("status" => "ok"));
    }
    
    public function delete($id) {
        $this->getAlbumTable()->deleteAlbum($id);
        return new JsonModel(array("status" => "ok"));
    }
    
    public function getAlbumTable()
    {
    	if (!$this->albumTable) {
    		$sm = $this->getServiceLocator();
    		$this->albumTable = $sm->get('Album\Model\AlbumTable');
    	}
    	return $this->albumTable;
    }
    
}
<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Album\Model\Album;

class AlbumRestController extends AbstractRestfulController
{
    
    protected $albumTable;
    
    /**
     * test with
     * curl -i -H "Accept: application/json" http://zf2.local/album-rest/1
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
     */
    public function get($id) {
        return new JsonModel(array("album" => $this->getAlbumTable()->getAlbum($id)));
    }
    
    /**
     * Test with
     * curl -i -H "Accept: application/json" http://zf2.local/album-rest
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
     */
    public function getList() {
        $albums = $this->getAlbumTable()->fetchAll();
        $data = array();
        foreach ($albums as $album)
        	$data[] = $album;
        
        return new JsonModel(array(
    		'albums' => $data,
        ));
    }
    
    /**
     * Test with
     * curl -i -H "Accept: application/json" -X PUT -d "artist=New 2&title=New Title 2" http://zf2.local/album-rest/2
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
     */
    public function update($id, $data) {
        $album = $this->getAlbumTable()->getAlbum($id);
        foreach ($data as $key => $value) {
            $album->$key = $value;
        }
        $this->getAlbumTable()->saveAlbum($album);
        return new JsonModel(array("status" => "ok"));
    }
    
    /**
     * Test With 
     * curl -i -H "Accept: application/json" -X POST -d "artist=Some Name&title=Some Title" http://zf2.local/album-rest
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    function create($data) {
        $album = new Album();
        $album->exchangeArray($data);
        $this->getAlbumTable()->saveAlbum($album);
        return new JsonModel(array("status" => "ok"));
    }
    
    /**
     * Test with
     * curl -i -H "Accept: application/json" -X DELETE http://zf2.local/album-rest/14
     * (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
     */
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
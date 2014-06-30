<?php
namespace Album;

// Add these import statements:
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
     public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
//     public function getControllerConfig() {
//     	return array(
//     			'factories' => array(
//     					'commentController' => function ($sm) {
//     						$controller = new \Comment\Controller\CommentController();
//     						$locator = $sm->getServiceLocator();
//     						$controller->setCommentForm($locator->get('commentForm'));
//     						$controller->setCommentService($locator->get('commentService'));
//     						return $controller;
//     					},
//     					'Album\Controller\AlbumApigilityController' => function ($sm) {
// 	    					$controller = new \Album\Controller\AlbumApigilityController();
// 	    					$locator = $sm->getServiceLocator();
// 	    					$controller->setAlbumService($locator->get('Album\Service\AlbumService'));
// 	    					return $controller;
//     					}
//     			)
//     	);
//     }
    
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Album\Model\AlbumTable' =>  function($sm) {
    						$tableGateway = $sm->get('AlbumTableGateway');
    						$table = new AlbumTable($tableGateway);
    						return $table;
    					},
    					'AlbumTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Album());
    						return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
    					},
    					'Album\Model\AlbumMapper' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$adapterMaster 	= $sm->get('dbMasterAdapter');
    						$adapterSlave 	= $sm->get('dbSlaveAdapter');
    						$mapper = new \Album\Model\AlbumMapper($adapterMaster, $adapterSlave);
    						return $mapper;
    					},  
    					
    					'Album\Service\AlbumOptions' => function ($sm) {
    						$config = $sm->get('Config');
    						return new \Album\Service\AlbumOptions(isset($config['album']) ? $config['album'] : array());
    					},
    					
    					'Album\Form\AlbumForm' 			=> 'Album\Form\AlbumFormFactory',
    					'Album\Service\AlbumService' 	=> 'Album\Service\AlbumServiceFactory',    					
    			),
    	);
    }
    
   
}

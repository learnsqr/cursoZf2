<?php
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Album\Model\Album;
use Zend\Db\TableGateway\TableGateway;

return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
            'Album\Controller\AlbumRest' => 'Album\Controller\AlbumRestController',
            'Album\Controller\AlbumClient' => 'Album\Controller\AlbumClientController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'album' => array(
        		'type'    => 'segment',
        		'options' => array(
    				'route'    => '/album[/][:action][/:id]',
    				'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
    				),
    				'defaults' => array(
						'controller' => 'Album\Controller\Album',
						'action'     => 'index',
    				),
        		),
            ),
            'album-rest' => array(
                'type'    => 'segment',
                'options' => array(
            		'route'    => '/album-rest[/:id]',
            		'constraints' => array(
        				'id'     => '[0-9]+',
            		),
            		'defaults' => array(
        				'controller' => 'Album\Controller\AlbumRest',
            		),
                ),
			),
            'album-client' => array(
        		'type'    => 'segment',
        		'options' => array(
    				'route'    => '/album-client[/][:action][/:id]',
    				'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
    				),
    				'defaults' => array(
						'controller' => 'Album\Controller\AlbumClient',
						'action'     => 'index',
    				),
        		),
            ),
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Album' => __DIR__ . '/../view',
        ),
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
    
    'service_manager' => array(
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
        ),
    ),
    
    
);

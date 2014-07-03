<?php
namespace Music;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Music\V1\Rest\Album\AlbumMapper' =>  function ($sm) {
    						$adapter 		= $sm->get('Zend\Db\Adapter\Adapter');
    						$adapterMaster 	= $sm->get('dbMasterAdapter');
    						$adapterSlave 	= $sm->get('dbSlaveAdapter');
    						return new \Music\V1\Rest\Album\AlbumMapper($adapterMaster, $adapterSlave);
    					},
    					'Music\V1\Rest\Album\AlbumResource' => function ($sm) {
    						$mapper = $sm->get('Music\V1\Rest\Album\AlbumMapper');
    						return new \Music\V1\Rest\Album\AlbumResource($mapper);
    					},
    					'Music\V2\Rest\Album\AlbumMapper' =>  function ($sm) {
    						$adapter 		= $sm->get('Zend\Db\Adapter\Adapter');
    						$adapterMaster 	= $sm->get('dbMasterAdapter');
    						$adapterSlave 	= $sm->get('dbSlaveAdapter');
    						return new \Music\V2\Rest\Album\AlbumMapper($adapterMaster, $adapterSlave);
    					},
    					'Music\V2\Rest\Album\AlbumResource' => function ($sm) {
    						$mapper = $sm->get('Music\V2\Rest\Album\AlbumMapper');
    						return new \Music\V2\Rest\Album\AlbumResource($mapper);
    					},
    			),
    	);
    }
}

<?php
/**
 * Local Database Configuration Override
 *
 * You can use this file for overriding database configuration values from modules, etc.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
		'service_manager' => array(
// 			'factories' => array(
// 					'Zend\Db\Adapter\Adapter'=> 'Zend\Db\Adapter\AdapterServiceFactory',						
// 			),
// 				'factories' => array(
// 						'Album\Model\AlbumTable' =>  function($sm) {
// 							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
// 							$slaveAdapter = $sm->get('My\Db\Adapter\SlaveAdapter');
// 							$table = new AlbumTable($dbAdapter, new MasterSlaveFeature($slaveAdapter));
// 							return $table;
// 						}
// 				)				
			'abstract_factories' => array(
					'Zend\Db\Adapter\AdapterAbstractServiceFactory',
			),
		),
);
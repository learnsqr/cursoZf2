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
			'abstract_factories' => array(
					'Zend\Db\Adapter\AdapterAbstractServiceFactory',
			),
		),
);
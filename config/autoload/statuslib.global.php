<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

return array(

		'db' => array(
				'adapters' => array(
						'MyDb' => array(
								'driver' => 'pdo_sqlite',
								'database' => __DIR__ . '/../../data/statuslib.db'
						)
				)
		),
		'statuslib' => array(
				'db' => 'MyDb',
				'table' => 'status',
		),
		'service_manager' => array(
				'aliases' => array(
						'StatusLib\Mapper' => 'StatusLib\TableGatewayMapper',
				),
				'abstract_factories' => array(
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterAbstractServiceFactory',
				)
		),
);
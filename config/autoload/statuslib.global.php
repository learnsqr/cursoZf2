<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

return array(
    'statuslib' => array(
    	'db' => 'Zend\Db\Adapter\Adapter',
    	'table' => 'status',
        //'array_mapper_path' => 'path/to/PHP/file/returning/array.php',
    ),
    'service_manager' => array(
        'aliases' => array(
        	// Set to either 
        	'StatusLib\Mapper' => 'StatusLib\TableGatewayMapper',
        	//'StatusLib\Mapper' => 'StatusLib\ArrayMapper',
        ),
        'abstract_factories' => array(
    		'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterAbstractServiceFactory',
    	)
    ),
);

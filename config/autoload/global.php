<?php


$dbParams = array(
    'database'  => 'zf2',
    'username'  => 'php',
    'password'  => '1234',
    'hostname'  => 'localhost',
);

return array(
		'db' => array(
				'driver'         => 'Pdo',
				'dsn'            => 'mysql:dbname=zf2;host=localhost',
					'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
				'driver_options' => array(
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
				),
		),
		'service_manager' => array(
				'factories' => array(
						'Zend\Db\Adapter\Adapter'
						=> 'Zend\Db\Adapter\AdapterServiceFactory',
				),
		),
);
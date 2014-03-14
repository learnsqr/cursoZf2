<?php

$settings = array(
   
    
	/**
	 * Some Var Here
	 *
	 * Some description here
	 *
	 * Default value: 1 (active)
	 * Accepted values: 1 (active), 2 (email sended), 3 (disabled), 4 (inactive)
	 */
	//'some_var_here' => 1,
		
	/**
	 * Breaker table name
	 */
	//'table_name' => 'ork_projects',
       
);

/**
 * You do not need to edit below this line
 */
return array(
    'breaker' => $settings,
    'service_manager' => array(
    		'aliases' => array(
    				'breaker_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter']: 'Zend\Db\Adapter\Adapter',
    		),
    ),
);

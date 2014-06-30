<?php
return array(		
    array(
    	'label' => 'Developers',
    	'route' => 'developer',
    	'pages' => array(
    	    array(
    	    		'label' => 'Developer',
    	    		'route' => 'developer',
    	    		'action' => 'index',
    	    ),
    			
    			array(
    					'label' => 'Status',
    					'route' => 'infostatus',
    					'action' => 'status',
    			),
    			array(
    					'label' => 'Debug',
    					'route' => 'debug',
    					'action' => 'index',
    					'pages' => array(
    							array(
    									'label' => 'All Routes',
    									'route' => 'debug',
    									'action' => 'allroutes',
    							),
    					),
    			),
	    	array(
	    		'label' => 'Docs',
	    		'route' => 'markdown',
	    		'action' => 'index',
	    	    'order' => 100,
	    	    'pages' => array(
	    	    		array(
	    	    				'label' => 'About this',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'do'),
	    	    				'pages' => array(
	    	    						array(
					    	    				'label' => 'Markdown Syntax',
					    	    				'route' => 'markdown',
					    	    				'params'     => array('filename' => 'markdown-syntax')
					    	    		),	    	    				
	    	    				),
	    	    		),
	    	    		array(
	    	    				'label' => 'Confs & Installs',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'install-and-confs'),
	    	    				'pages' => array(
	    	    						array(
					    	    				'label' => 'Social',
					    	    				'route' => 'markdown',
					    	    				'params'     => array('filename' => 'social')
					    	    		),
					    	    		array(
					    	    				'label' => 'Bower',
					    	    				'route' => 'markdown',
					    	    				'params'     => array('filename' => 'bower')
					    	    		),
	    	    						array(
	    	    								'label' => 'Erratas',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'erratas')
	    	    						),
	    	    						array(
	    	    								'label' => 'Apigility',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'apigility')
	    	    						),
	    	    						
	    	    				),
	    	    		),
	    	    		
    	    	        
	    	    		array(
	    	    				'label' => 'Web Theory',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'http-status-codes'),
	    	    				'pages' => array(
	    	    						array(
	    	    								'label' => 'HTTP status codes',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'http-status-codes')
	    	    						),
	    	    						array(
	    	    								'label' => 'Ful Mapper',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'fulmapper')
	    	    						),
	    	    						
	    	    				
	    	    				),
	    	    		),
	    	    		
	    	    		
	    	    			    	    		
	    	    		array(
	    	    				'label' => 'Wordpress',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'wordpress')
	    	    		),
	    	    		
	    	    		array(
	    	    				'label' => 'ZF2 Theory & Code',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'views'),
	    	    				'pages' => array(
	    	    						array(
	    	    								'label' => 'Dispatch Process',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'dispatch')
	    	    						),
	    	    						array(
	    	    								'label' => 'Views',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'views')
	    	    						),
	    	    						array(
	    	    								'label' => 'Config Listers',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'config-listeners')
	    	    						),
	    	    						array(
	    	    								'label' => 'Services',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'services')
	    	    						),
	    	    						array(
	    	    								'label' => 'Dependencies',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'dependencies')
	    	    						),
	    	    						array(
	    	    								'label' => 'Sevice Locator',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'servicelocator')
	    	    						),
	    	    						array(
	    	    								'label' => 'Post Redirect Get',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'postredirectget')
	    	    						),
	    	    						array(
	    	    								'label' => 'Hydrators',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'hydrators')
	    	    						),
	    	    						array(
	    	    								'label' => 'Logs',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'logs')
	    	    						),
	    	    				),
	    	    		),
	    	    		array(
	    	    				'label' => 'Api',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'api'),
	    	    				'pages' => array(
	    	    						array(
	    	    								'label' => 'Api Considerations',
	    	    								'route' => 'markdown',
	    	    								'params'     => array('filename' => 'api-considerations')
	    	    						),	    	    						
	    	    				),
	    	    		),
	    	    ),
	    	),	    	
    	),
	),
	
);

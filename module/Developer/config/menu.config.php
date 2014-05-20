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
	    		'label' => 'Docs',
	    		'route' => 'markdown',
	    		'action' => 'index',
	    	    'order' => 100,
	    	    'pages' => array(
	    	    		array(
	    	    				'label' => 'Do',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'do')
	    	    		),
	    	    		array(
	    	    				'label' => 'Apigility',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'apigility')
	    	    		),
    	    	        array(
    	    	        		'label' => 'Ful Mapper',
    	    	        		'route' => 'markdown',
    	    	        		'params'     => array('filename' => 'fulmapper')
	    	          ),
	    	    		array(
	    	    				'label' => 'HTTP status codes',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'http-status-codes')
	    	    		),
	    	    		array(
	    	    				'label' => 'Markdown Sintax',
	    	    				'route' => 'markdown',
	    	    				'params'     => array('filename' => 'markdown-sintax')
	    	    		),
	    	    ),
	    	),	    	
    	),
	),
	
);

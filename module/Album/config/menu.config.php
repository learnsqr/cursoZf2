<?php
return array(			
	    array(
	    	'label' => 'Albums',
	    	'route' => 'album',
	    	'order' => 1,
	    	'pages' => array(
	    	    array(
	    	    		'label' => 'Album',
	    	    		'route' => 'album',
	    	    		'action' => 'index',
	    	    		
	    	    ),
		    	array(
		    		'label' => 'Client',
		    		'route' => 'albumclient',
		    		'action' => 'index',
		    	),
		    	array(
		    		'label' => 'Apigility',
		    		'route' => 'albumapigility',
		    		'action' => 'index',
		    	),
		    	array(
		    		'label' => 'Rest',
		    		'route' => 'albumrest',
		    		'action' => 'index',
		    	),
	    	),
		),
);
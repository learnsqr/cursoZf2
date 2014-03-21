<?php
return array(		
    array(
    	'label' => 'Album',
    	'route' => 'album',
    	'order' => 1,
    	'pages' => array(
    	    array(
    	    		'label' => 'Index',
    	    		'route' => 'album',
    	    		'action' => 'index',
    	    ),
	    	array(
	    		'label' => 'Add',
	    		'route' => 'album',
	    		'action' => 'add',
	    	),
	    	array(
	    		'label' => 'Edit',
	    		'route' => 'album',
	    		'action' => 'edit',
	    	),
	    	array(
	    		'label' => 'Delete',
	    		'route' => 'album',
	    		'action' => 'delete',
	    	),
    	),
	),
	
);
<?php
return array(		
    array(
    	'label' => 'Task',
    	'route' => 'task',
    	'pages' => array(
    	    array(
    	    		'label' => 'List',
    	    		'route' => 'task',
    	    		'action' => 'index',
    	    ),
	    	array(
	    		'label' => 'Add',
	    		'route' => 'task',
	    		'action' => 'add',
	    	),
	    	array(
	    		'label' => 'Edit',
	    		'route' => 'task',
	    		'action' => 'edit',
	    	),
	    	array(
	    		'label' => 'Delete',
	    		'route' => 'task',
	    		'action' => 'delete',
	    	),
    	),
	),
	
);
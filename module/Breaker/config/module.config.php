<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
    		'invokables' => array(
    				'Breaker\Controller\Index' => 'Breaker\Controller\IndexController',
    		        'Breaker\Controller\Option' 	=> 'Breaker\Controller\OptionController',
    		),
    ),
    
    'router' => array(
        'routes' => array(
            'option' => array(
            		'type'    => 'segment',
            		'options' => array(
            				'route'    => '/option[/][:action][/:id]',
            				'constraints' => array(
            						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            						'id'     => '[0-9]+',
            				),
            				'defaults' => array(
            						'controller' => 'Breaker\Controller\Option',
            						'action'     => 'index',
            				),
            		),
            ),
                       
            'breaker' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/breaker',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Breaker\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                    
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
   
    'view_manager' => array(
    		'template_path_stack' => array(
    				'option' => __DIR__ . '/../view',
    		),
    		'strategies' => array(
    				'ViewJsonStrategy',
    		),
    ),
    
);

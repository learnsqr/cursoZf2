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
            'Developer\Controller\Index' => 'Developer\Controller\IndexController',
            'Developer\Controller\Markdown' => 'Developer\Controller\MarkdownController'
        ),
    ),
    'router' => array(
        'routes' => array(   
            'developer' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/developer',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Developer\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
//                 'may_terminate' => true,
//                 'child_routes' => array(
//                     'default' => array(
//                         'type'    => 'Segment',
//                         'options' => array(
//                             'route'    => '/[:controller[/:action]]',
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                             ),
//                             'defaults' => array(
//                             ),
//                         ),
//                     ),
//                 ),
            ),
            'markdown' => array(
            		'type'    => 'segment',
            		'options' => array(
            				'route'    => '/docs[/:filename]',
            				'defaults' => array(
            						'controller' => 'Developer\Controller\Markdown',
            						'action'     => 'index',
            				),
            		),
            ),
        ),
    ),
    'view_manager' => array(
            'template_path_stack' => array(
                    'developer' => __DIR__ . '/../view',
            ),
            
    ),
    'navigation' => array(
    		'default' => include('menu.config.php')
    ),    
    
);

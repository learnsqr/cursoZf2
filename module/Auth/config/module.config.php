<?php


return array(
		'controllers' => array(
				'invokables' => array(
						'Auth\Controller\Login' 		=> 'Auth\Controller\LoginController',
				),
		),

		// The following section is new and should be added to your file
		'router' => array(
				'routes' => array(
						'login' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/login[/][:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Auth\Controller\Login',
												'action'     => 'login',
										),
								),
						),

				),
		),

		'view_manager' => array(
				'template_path_stack' => array(
						'login' => __DIR__ . '/../view',
				),
		),
);

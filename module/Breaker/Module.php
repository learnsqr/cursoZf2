<?php
/*
 * Read order of config functions and variables
 *
 * 	getConfig()
 *  getServiceConfig() translates to $config['service_manager']
 * 	getControllerConfig() translates to $config['controllers']
 * 	getControllerPluginConfig() translates to $config['controller_plugins']
 * 	getViewHelperConfig() translates to $config['view_helpers']
 * 	getValidatorConfig() translates to $config['validators']
 * 	getFilterConfig() translates to $config['filters']
 * 	getFormElementConfig() translates to $config['form_elements']
 * 	getRouteConfig() translates to $config['route_manager']
 * 	alphabetically config/autoload/{,*.}{global,local}.php. 
 * 
 */

namespace Breaker;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
   
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getConfig()
    {
    	return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
    	return array(
    			'invokables' => array(
    			    'breaker_option_service'			       => 'Breaker\Service\Option',
    			    'breaker_option_form'			       => 'Breaker\Form\Option',
    			    'breaker_option_form_hydrator'         => 'Breaker\Mapper\OptionHydrator'
    			    
    					//'breaker_service'			       => 'Breaker\Service\Servicename',
    					//'Breaker\Form\Add'	           => 'Breaker\Form\Add',
    					//'breaker_add_form_hydrator'        => 'Zend\Stdlib\Hydrator\ClassMethods',
    			),
    			'factories' => array(
    					'breaker_module_options' => function ($sm) {
    						$config = $sm->get('Config');
    						return new Options\ModuleOptions(isset($config['breaker']) ? $config['breaker'] : array());
    					},
    					
    					'breaker_mapper' => function ($sm) {
    						$options = $sm->get('breaker_module_options');
    						$mapper = new Mapper\Project();
    						$mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
    						$entityClass = $options->getProjectEntityClass();
    						$mapper->setEntityPrototype(new $entityClass);
    						$mapper->setHydrator(new Mapper\BreakerHydrator());
    						//$mapper->setTableName($options->getTableName());
    						return $mapper;
    					},
    					
    					'option_mapper' => function ($sm) {
    						$options = $sm->get('breaker_module_options');
    						$mapper = new Mapper\Option();
    						$mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
    						$entityClass = 'Breaker\Entity\Option';
    						$mapper->setEntityPrototype(new $entityClass);
    						$mapper->setHydrator(new Mapper\OptionHydrator());
    						//$mapper->setTableName($options->getTableName());
    						return $mapper;
    					},
    						
    					
    			),
    	);
    }
}

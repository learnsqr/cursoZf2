# Dependencies injection 
REF:     

* <sup>1</sup> Lukas, David. __"Getting Dependencies into ZF2 Controllers"__ _Developer's daily encounters with Zend Framework_, 7 Jul 2012. Web [Getting Dependencies into ZF2 Controllers](http://www.zfdaily.com/2012/07/getting-dependencies-into-zf2-controllers/). Accessed 22 Jun 2014.  
* <sup>2</sup> Coury, Evans. __"ServiceManager plugin fixes #1695"__ _Github.com Repo: zendframework/zf2_, 5 Jul 2012. Web [zendframework/zf2](https://github.com/zendframework/zf2/pull/1695). Accessed 22 Jun 2014.  



## DI for Controllers 
<sup>1</sup> Controllers are services, remember? The MVC workflow retrieves the controller instances from the ServiceManager. But do not rush to trace and debug your app to check it’s ServiceManager ($application->getServiceManager()) and see with your own eyes the controller instances there. You won’t find them there. It’s not this ServiceManager. The controller instances are managed by a separate dedicated scoped ServiceManager instance. So we can use neither the service_manager key in a config file nor the getServiceConfig() method in the Module class to configure our controller instances. We are thus back to our initial question: How do we do a constructor injection on a controller?

The dedicated ServiceManager instance used exclusively for controllers can be configured in two places: controllers key in a config file and getControllerConfig() method in the Module class.

The controller classes which do not have any dependencies are set-up under the invokables subkey as a 'controllerServiceName' => 'Fully\Qualified\Controller\Classname' pairs. 

`module.config.php`  

	<?php
	return array(
	    'controllers' => array(
	        'invokables'    => array(
	            //Suppose one of our routes specifies
	            //a controller named 'myController'
	            'myController'    => 'MyModule\Controller\MyController',
	        ),
	    ),
	);
	
The easiest method to create controller instances which do have dependencies is to use a factory. You can either write a proper factory implementing the Zend\ServiceManager\FactoryInterface:

`MyModule/src/MyModule/ControllerFactory/MyControllerFact.php`  

	namespace MyModule/ControllerFactory;
	use \Zend\ServiceManager\FactoryInterface;
	use \Zend\ServiceManager\ServiceLocatorInterface;
	 
	class MyControllerFact implements FactoryInterface
	{
	    public function createService(ServiceLocatorInterface $serviceLocator) {
	        /* @var $serviceLocator \Zend\Mvc\Controller\ControllerManager */
	        $sm   = $serviceLocator->getServiceLocator();
	        $depA = $sm->get('depA');
	        $depB = $sm->get('depB');
	        $controller = new \MyModule\Controller\MyController($depA, $depB);
	        return $controller;
	    }
	}
	
And then simply put the reference to this factory under the factories subkey into the configuration file:

`module.config.php`  

	<?php
	return array(
	    'controllers' => array(
	        'factories'    => array(
	            //Suppose one of our routes specifies
	            //a controller named 'myController'
	            'myController'    => 'MyModule\ControllerFactory\MyControllerFact',
	        ),
	    ),
	);
	
Or you can use a closure and define the factory as a part of the configuration. Be careful though not to do this in the configuration file (please see the note Configuration and PHP on the ServiceManager Quick Start page for reasons). The proper place for this is the getControllerConfig() method:

`MyModule/Module.php` 

	<?php
	namespace MyModule;
	use \Zend\Mvc\Controller\ControllerManager;
 
	class Module
	{
	    public function getControllerConfig() {
	        return array(
	            'factories' => array(
	                //Suppose one of our routes specifies
	                //a controller named 'myController'
	                'myController'    => function(ControllerManager $cm) {
	                    $sm   = $cm->getServiceLocator();
	                    $depA = $sm->get('depA');
	                    $depB = $sm->get('depB');
	                    $controller = new \MyModule\Controller\MyController($depA,
	                                                                        $depB);
	                    return $controller;
	                },
	            ),
	        );
	 
	    //The getConfig() and getAutoloaderConfig() methods are omitted for brevity
	}
	
## DI for View Helpers

<sup>2</sup> In the factory for the view helper, you'd do something like this  

	<?php
	return array(
	    'view_helpers' => array(
	        'factories' => array(
	            'foohelper' => function($sm) {
	                $helper = new My\View\Helper\FooHelper;
	                $request = $sm->getServiceLocator()->get('Request');
	                $helper->setRequest($request);
	                return $helper;
	            }
	        )
	    )
	);
# ServiceLocator Injection

REF: 
 
* <sup>1</sup> Weier O'Phinney, Matthew. __"ServiceLocator in Model classes."__ _Zend Framework Community, Nabble.com_, 17 Sep 2012. Web [ServiceLocator in Model classes](http://zend-framework-community.634137.n4.nabble.com/ServiceLocator-in-Model-classes-td4656863.html). Accessed 23 Jun 2014.


## Into Services

Is there are any way to get ServiceLocator or other DI manager in other classes, Model classes  for example? 
Yes -- implement Zend\ServiceManager\ServiceLocatorAwareInterface, and 
then define a service for your model somewhere in your configuration, 
and make sure you pull your model from the service locator. What I mean 
is: 

    class SomeModel implements ServiceLocatorAwareInterface 
    { 
        protected $services; 

        public function setServiceLocator(ServiceLocatorInterface $locator) 
        { 
            $this->services = $locator; 
        } 

        public function getServiceLocator() 
        { 
            return $this->services; 
        } 
    } 

From there, make sure SomeModel is in your service configuration, and 
that you fetch it from the SM instance. 

### `"I recommend not doing this"` Aproach  
  
That said, __I recommend not doing this__. Use the ServiceManager for 
Inversion of Control. By this I mean: have a factory for the model that 
injects dependencies into the newly created instance, and then inject 
the model where you need it. 

As an example: 

    'service_manager' => array('factories' => array( 
        'SomeModel' => function ($services) { 
            $db          = $services->get('Zend\Db\Adapter\Adapter'); 
            $inputFilter = $services->get('Some\InputFilter'); 
            $model       = new SomeModel(); 
            $model->setDbAdapter($db); 
            $model->setInputFilter($inputFilter); 
            return $model; 
        }, 
    )), 

    'controllers' => array('factories' => array( 
        'SomeController' => function ($controllers) { 
            $services = $controllers->getServiceLocator(); 
            $model    = $services->get('SomeModel'); 

            $controller = new Some\Controller(); 
            $controller->setModel($model); 
            return $controller; 
        }, 
    )), 

This approach allows you to easily substitute different implementations 
when necessary. Additionally, it provides you with an explicit 
documentation of what dependencies a given class has. These two factors 
combined will help make your code more testable, and more easily 
extended and maintained. 
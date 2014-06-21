# About Config Listeners and loading priority
REF:     

* <sup>1</sup> Minds, Sam. __"Understanding ZF2 Configuration."__ _Sam Minds: Some Zend Framework 2 knowledge_, 08 Abr 2014. Web [Understanding ZF2 Configuration](http://samminds.com/2013/04/understanding-zf2-configuration/). Accessed 20 Jun 2014.

## The ConfigListener

Ultimately what the ConfigListener does is to call the function `getConfig()` of the Module-Classes. This happens for every single Module. And all Module->getConfig() will be merged into one internal configuration.

## The ServiceListener

The Role of the ServiceListener is similar. The ServiceListener ultimately calls all the other config functions of the Module classes. The exact functions that will be called are:

* __getServiceConfig()__ translates to $config['service_manager']
* __getControllerConfig()__ translates to $config['controllers']
* __getControllerPluginConfig()__ translates to $config['controller_plugins']
* __getViewHelperConfig()__ translates to $config['view_helpers']
* __getValidatorConfig()__ translates to $config['validators']
* __getFilterConfig()__ translates to $config['filters']
* __getFormElementConfig()__ translates to $config['form_elements']
* __getRouteConfig()__ translates to $config['route_manager']

## The Load-Order

The very interesting question is now: Who’s last?

To make the long story short, the first function to be called is `getConfig()` and after that all functions provided by the several `ServiceListener` are called in the above listed order. So ultimately the specific functions like `getServiceConfig()` or `getViewHelperConfig()` will take priority over the configuration served by `getConfig()`.

## The /autoload/ configuration

The last things to load would be the configuration files served under `config/autoload/{,*.}{global,local}.php`. Those files could practically overwrite everything, again ;)

The load order here is alphabetically. The whole directory will be fetched and all matching PHP files will be merged into the existing configuration.

## Conclusion

Internally a lot of stuff happens, when setting up the modules. And it is important to know about the load-order of the configuration steps. Finding out about this sure will leave me away from needless debugging time in the future. So whenever you encounter some problems with your configuration, now you know where to look for errors.

1. __application.config.php__
2. __$module->getConfig()__
3. __$module->get{,*}Config()__ (or ServiceListeners)
4. __/config/autoload/{,.*}{global,local}.php__
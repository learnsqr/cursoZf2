# Workarounds for some erros in vendor's modules



## vendor/danielss89/zfc-user-admin/config/services.config.php

Catchable fatal error: Argument 1 passed to ZfcUser\Mapper\UserHydrator::__construct() must be an instance of Zend\Crypt\Password\PasswordInterface, none given, called in /Some/Path/vendor/danielss89/zfc-user-admin/config/services.config.php on line 92 and defined in /Some/Path/vendor/zf-commons/zfc-user/src/ZfcUser/Mapper/UserHydrator.php on line 21
	
#### DO:  
use Zend\Crypt\Password\Bcrypt;  
...  
$crypto  = new Bcrypt;  
$crypto->setCost($zfcUserOptions->getPasswordCost());  
$mapper->setHydrator(new UserHydrator($crypto));  


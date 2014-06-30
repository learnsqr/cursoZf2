# Logs and Firebug Log

## To use

### In Controllers

	$logger = new \Zend\Log\Logger;
	$logger->addWriter(new \Zend\Log\Writer\Stream('data/logs/apiclient.log'));
	
	$firephp = $this->getServiceLocator()->get('Zend\Log\FirePhp');
	$firephp->info("info log");
	$firephp->warn("warn log");
	$firephp->crit("critical log");
	
	$logger->debug('edit enter');
	
### In Service

	use Zend\Log\Logger;
	use Zend\Log\Writer\Stream;

	$logger = new Logger;
	$logger->addWriter(new Stream('data/logs/apiclient.log'));
	$logger->debug($url);
	$logger->debug($method);
	$logger->debug(serialize($postData));
	
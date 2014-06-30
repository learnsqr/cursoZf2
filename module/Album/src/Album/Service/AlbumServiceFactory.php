<?php

namespace Album\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Album\Service\AlbumService;
use Album\Service\AlbumOptions;

class AlbumServiceFactory implements FactoryInterface
{
	
	/**
	 * @var AlbumOptions
	 */
	protected $options;
	
	/**
	 * {@inheritDoc}
	 *
	 * @return \BjyAuthorize\Service\Authorize
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
 		$options = $this->getOptions($serviceLocator);
		$service = new AlbumService($options, $serviceLocator);

// 		$service->setAlbumForm($serviceLocator->get('albumForm'));
		
		return $service;
	} 
	
	
	/**
	 * set options
	 *
	 * @param ModuleOptions $options
	 * @return AdapterChainServiceFactory
	 */
	public function setOptions(AlbumOptions $options)
	{
		$this->options = $options;
		return $this;
	}
	
	/**
	 * get options
	 *
	 * @param ServiceLocatorInterface $serviceLocator (optional) Service Locator
	 * @return ModuleOptions $options
	 * @throws OptionsNotFoundException If options tried to retrieve without being set but no SL was provided
	 */
	public function getOptions(ServiceLocatorInterface $serviceLocator = null)
	{
		if (!$this->options) {
			if (!$serviceLocator) {
				throw new \RuntimeException(
						'Options were tried to retrieve but not set ' .
						'and no service locator was provided'
				);
			}
	
			$this->setOptions($serviceLocator->get('Album\Service\AlbumOptions'));
		}
	
		return $this->options;
	}
		
}

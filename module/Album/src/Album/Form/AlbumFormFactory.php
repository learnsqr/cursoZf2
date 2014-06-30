<?php
namespace Album\Form;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

use Album\Model\AlbumEntity;
use Album\Form\AlbumForm;
use Album\Form\AlbumFilter;
use Album\Service\AlbumOptions;

class AlbumFormFactory implements FactoryInterface
{
	/**
	 * @var AlbumOptions
	 */
	protected $options;
	
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$options = $this->getOptions($serviceLocator)->toArray();
		
 		$form = new AlbumForm('album', $options);
 		
 		$form->setHydrator(new ClassMethods())
 			 ->setObject(new AlbumEntity());
 			 
        $form->setInputFilter(new AlbumFilter());
        
        return $form;
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
<?php

namespace Album\Service;

use Zend\Stdlib\AbstractOptions;

class AlbumOptions extends AbstractOptions 
{
    /**
     * A default option value pair
     * @var string
     */
    protected $defaultName = 'default value';
    
    /**
     * Album API endpoints
     * @var string
     */
    protected $endpointHost 			= 'http://cursozf2.local';
    protected $endpointAlbums 			= '/albums';
    protected $endpointAlbumsData 		= '/albums/%s';
    
    /**
     * @var bool
     */
    protected $useRedirectParameterIfPresent = true;
    
    /**
     * @var bool
     */
    protected $redirectRoute = 'albumapigility';
    
    
    
    /**************************************************** Getters & Setters *******************************/
    
	/**
	 * @param string $defaultName
	 */
	public function setDefaultName($defaultName) {
		$this->defaultName = $defaultName;
	}
	
	/**
	 * @return the $defaultName
	 */
	public function getDefaultName() {
		return $this->defaultName;
	}
	/**
	 * @return the $endpointHost
	 */
	public function getEndpointHost() {
		return $this->endpointHost;
	}

	/**
	 * @return the $endpointAlbums
	 */
	public function getEndpointAlbums() {
		return $this->endpointAlbums;
	}

	/**
	 * @return the $endpointAlbumsData
	 */
	public function getEndpointAlbumsData() {
		return $this->endpointAlbumsData;
	}

	/**
	 * @param string $endpointHost
	 */
	public function setEndpointHost($endpointHost) {
		$this->endpointHost = $endpointHost;
	}

	/**
	 * @param string $endpointAlbums
	 */
	public function setEndpointAlbums($endpointAlbums) {
		$this->endpointAlbums = $endpointAlbums;
	}

	/**
	 * @param string $endpointAlbumsData
	 */
	public function setEndpointAlbumsData($endpointAlbumsData) {
		$this->endpointAlbumsData = $endpointAlbumsData;
	}
	/**
	 * @return the $useRedirectParameterIfPresent
	 */
	public function getUseRedirectParameterIfPresent() {
		return $this->useRedirectParameterIfPresent;
	}

	/**
	 * set use redirect param if present
	 *
	 * @param bool $useRedirectParameterIfPresent
	 * @return ModuleOptions
	 */
	public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent) {
		$this->useRedirectParameterIfPresent = $useRedirectParameterIfPresent;
		return $this;
	}
	
	/**
	 * @return the $redirectRoute
	 */
	public function getRedirectRoute() {
		return $this->redirectRoute;
	}

	/**
	 * @param boolean $redirectRoute
	 */
	public function setRedirectRoute($redirectRoute) {
		$this->redirectRoute = $redirectRoute;
	}



	
	

	
	
    
}

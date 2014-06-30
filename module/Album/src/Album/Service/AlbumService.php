<?php

namespace Album\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\AbstractOptions;
use Album\Service\AlbumServiceInterface as AlbumServiceInterface;
use Album\Model\AlbumEntity;
use Zend\Stdlib\Hydrator\ClassMethods;

use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Json\Json;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class AlbumService implements AlbumServiceInterface
{
    
    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     * @var array
     */
    protected $options;
    
    /**
     * Holds the client we will reuse in this class
     *
     * @var Client
     */
    protected static $client = null;
        
  
    public function __construct(AbstractOptions $options, ServiceLocatorInterface $serviceLocator)
    {    
    	$this->options		  = $options;
    	$this->serviceLocator = $serviceLocator;    	
    }
    
    /**
     * The default action - show the home page
     */
    public function fetchAll(array $filter=null)
    {
    	$url = $this->options->getEndpointHost() . sprintf($this->options->getEndpointAlbums());
    	$albums = self::doRequest($url);
    	
    	$iteratorAdapter = new ArrayAdapter((array) $albums->_embedded->album);
    	$paginator = new Paginator($iteratorAdapter);
    	$paginator->setItemCountPerPage(25);
    	
    	return $paginator;    	
    }
    
    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
 	public function fetch($id)
    {
    	$url = $this->options->getEndpointHost() . sprintf($this->options->getEndpointAlbumsData(), $id);
    	$album = self::doRequest($url,Json::TYPE_ARRAY);
    	    	
		$albumEntity = new AlbumEntity();
    	$hydrator = new ClassMethods();    	
    	$hydrator->hydrate($album, $albumEntity);  	
		return $albumEntity;
//     	return $hydrator->extract($albumEntity);
    }
     
    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
    	unset($data['id']);
    	$url = $this->options->getEndpointHost() . sprintf($this->options->getEndpointAlbums());
    	$album = self::doRequest($url,Json::TYPE_ARRAY,$data,Request::METHOD_POST);
		
    	$albumEntity = new AlbumEntity();
    	$hydrator = new ClassMethods();
    	$hydrator->hydrate($album, $albumEntity);
    	return $albumEntity;    	
    }
    
    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($data)
    {    	
    	$url = $this->options->getEndpointHost() . sprintf($this->options->getEndpointAlbumsData(), $data['id']);
    	$album = self::doRequest($url,Json::TYPE_OBJECT,$data,Request::METHOD_PUT);
    	
    	return $album;
    }
	
    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function delete($data)
    {
    	$url = $this->options->getEndpointHost() . sprintf($this->options->getEndpointAlbumsData(), $data['id']);
    	$album = self::doRequest($url,Json::TYPE_OBJECT,$data,Request::METHOD_DELETE);
    	 
    	return $data['id'];
    }
	
	
	/************************************** API ACCESS ************************************/
	
	/**
	 * Create a new instance of the Client if we don't have it or
	 * return the one we already have to reuse
	 *
	 * @return Client
	 */
	protected static function getClientInstance()
	{
		if (self::$client === null) {
			self::$client = new Client();
// 			self::$client->setAdapter(new Curl());
// 			self::$client->setEncType(Client::ENC_URLENCODED);
		}
	
		return self::$client;
	}
	
	/**
	 * Perform a request to the API
	 *
	 * @param string $url
	 * @param array $postData
	 * @param Client $client
	 * @return Zend\Http\Response
	 */
	protected static function doRequest($url, $decodeType = Json::TYPE_OBJECT, array $postData = null,  $method = Request::METHOD_GET)
	{
		$client = self::getClientInstance();
		$client->setUri($url);
		$client->setMethod($method);
		
		if ($postData !== null)
			$client->setParameterPost($postData);
	
		$client->setHeaders(array('Accept' 			=> 'application/vnd.music.v1+json',
								  'Content-Type' 	=> 'application/json',
								  'Accept-Encoding'	=> 'UTF-8',	
		));
		
		if ($postData !== null) {
			$client->setRawBody(Json::encode($postData, true));
			$client->setEncType('application/json');
		}		
		$response = $client->send();
	
		if ($response->isSuccess()) 
		{						
			return JsonDecoder::decode($response->getBody(), $decodeType);
		}
		else
		{	
			// FIXME: Remove on production
			$logger = new Logger;
			$logger->addWriter(new Stream('data/logs/apiclient.log'));
			$logger->debug($response->getBody());
			return $response->getBody();
		}
	}

}

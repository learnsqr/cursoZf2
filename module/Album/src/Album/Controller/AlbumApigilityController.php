<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Json\Json;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

/**
 * AlbumClientController
 *
 * @author
 *
 * @version
 *
 */
class AlbumApigilityController extends AbstractActionController
{
	/**
	 * Holds the client we will reuse in this class
	 *
	 * @var Client
	 */
	protected static $client = null;
	
	/**
	 * Holds the endpoint urls
	 *
	 * @var string
	 */
	protected static $endpointHost = 'http://cursozf2.local';
	protected static $endpointAlbums = '/albums';
	protected static $endpointAlbumsData = '/albums/%s';
	
    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
    	$url = self::$endpointHost . sprintf(self::$endpointAlbums);
    	$albums = self::doRequest($url);        
        $model = new ViewModel(array("albums" => $albums->_embedded->album));
        return $model;
    }

    
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
            self::$client->setEncType(Client::ENC_URLENCODED);
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
    protected static function doRequest($url, array $postData = null, $method = Request::METHOD_GET)
    {
        $client = self::getClientInstance();
        $client->setUri($url);
        $client->setMethod($method);
        
        if ($postData !== null) 
            $client->setParameterPost($postData);
        
        
        $client->setHeaders(array('Accept'=>'application/vnd.music.v1+json',
        						  'Content-Type'=>'application/json'
        		
        ));
        // $request = $client->getRequest();
        $response = $client->send();
        
        if ($response->isSuccess()) 
            return JsonDecoder::decode($response->getBody(), Json::TYPE_OBJECT);
        else 
        {
            $logger = new Logger;
            $logger->addWriter(new Stream('data/logs/apiclient.log'));
            $logger->debug($response->getBody());
            return FALSE;
        }
    }
    
}
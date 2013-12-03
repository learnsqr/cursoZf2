<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Client as HttpClient;

use Zend\View\Model\ViewModel;
use Album\Model\Album;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import
use Zend\Json\Json;

class AlbumClientController extends AbstractActionController
{
    
		
	public function indexAction()
    {	
  
    	$client = new HttpClient();
    	$client->setAdapter('Zend\Http\Client\Adapter\Curl');
    	
    	$client->setUri('http://zf2.local'.$this->getRequest()->getBaseUrl().'/album-rest');
    	$client->setMethod('GET');
    	$response = $client->send();
    	    	
    	if (!$response->isSuccess()) {
    		// report failure
    		$message = $response->getStatusCode().': '. 
    				   $response->getReasonPhrase();
    		 
    		$response = $this->getResponse();
    		$response->setContent($message);
    		return $response;
    	}
    	$body = $response->getBody();
    	 
    	$response = $this->getResponse();
    	$response->setContent($body);
    	
    	$albums = Json::decode($response->getContent(), Json::TYPE_OBJECT);
    	   
    	$result = new ViewModel();
//     	$result->setTemplate('album/album/index');
    	$result->setVariables(array(
    			'albums' => $albums->data,
    	));
    	
    	return $result;
    	 
    }

	

}
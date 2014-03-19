<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendOAuth\Consumer;
use Zend\Http\Client as HTTPClient,
ZendOAuth\OAuth;


use Auth\Form\LoginForm;       // <-- Add this import


class LoginController extends AbstractActionController
{
	
	/*************** INDEX *********/
	public function loginAction()
	{
		$form = new LoginForm();
		$form->get('submit')->setValue('Login');
		$request = $this->getRequest();
		if ($request->isPost()) {
		  /* 
            $form->setData($request->getPost());
			if ($form->isValid()) {
			    // Redirect to list of albums
                return $this->redirect()->toRoute('login');
			}
		  */
		}
		return array('form' => $form);
	}
	
	
	public function twitterAction()
	{
		$config = array(
				'callbackUrl'       => 'http://zf2.local',
				'consumerKey'       => '6m5PRdgc8L34OHt0jl7XQ',
				'consumerSecret'    => 'MbrgvIa7AQRCkNaHToKGdyIfuBPlhUVKKN2fo7k',
				'siteUrl'           => 'https://api.twitter.com/oauth',
				'authorizeUrl'      => 'https://api.twitter.com/oauth/authenticate',
				'requestTokenUrl'   => 'https://api.twitter.com/oauth/request_token',
				'accessTokenUrl'    => 'https://api.twitter.com/oauth/access_token'
		);

		$httpConfig = array(
				'adapter' => 'Zend\Http\Client\Adapter\Socket',
				'sslverifypeer' => false
		);
		$httpClient = new HTTPClient(null, $httpConfig);
		OAuth::setHttpClient($httpClient);
		
		
		$consumer = new Consumer($config);
		
		
		$token = null;
		
		if (!$token) {		
			$token = $consumer->getRequestToken();
			$_SESSION['TWITTER_REQUEST_TOKEN'] = serialize($token);
			$consumer->redirect();		
		}
	}
    
}
<?php
namespace Status\V1\Rpc\Ping;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
    	return new ViewModel(array(
    			'ack' => time(),
    	));
    }
}

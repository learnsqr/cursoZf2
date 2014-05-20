<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Developer for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Developer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MarkdownController extends AbstractActionController
{
    public function indexAction()
    {
    	$data = $this->params()->fromRoute('filename', 0);
    	if(file_exists(APPLICATION_PATH."/docs/developer/".$data.".md"))
    	{
    		
    		$data = file_get_contents(APPLICATION_PATH."/docs/developer/".$data.".md");
    		$model = new ViewModel(array('data' => $data));
    		$model->setTemplate("developer/markdown/marks");
    		return $model;
    	}
    	else if($data!==0)
    	{  
            $this->getResponse()->setStatusCode(404);
    	}
    	else
    	    $data=null;
    	
    	return array('data' => $data);
    }

   
}

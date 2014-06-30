<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Response as Response;


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
	 * @var UserControllerOptionsInterface
	 */
	protected $options;
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction()
	{
		//again: all these strings passed are case insensitive!
		$albumService = $this->getServiceLocator()->get('Album\Service\AlbumService');
			
	
		return new ViewModel(array(
				'paginator' => $albumService->fetchAll()
		));
	}	
	
	public function deleteAction()
{		
		// Start form, get things and read options, config and stuff
		$request = $this->getRequest();
		$service = $this->getServiceLocator()->get('Album\Service\AlbumService');		
		$form = $this->getServiceLocator()->get('Album\Form\AlbumForm');			
		 
		if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
			$redirect = $request->getQuery()->get('redirect');
		} else {
			$redirect = false;
		}
		
		// Pass in the route/url you want to redirect to after the POST
		$redirectUrl = $this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'delete')).($redirect?'?redirect='.$redirect:'');
		$prg = $this->prg($redirectUrl, true);		 
		
		if ($prg instanceof Response) {
			// Returned a response to redirect us
			return $prg;
		} elseif ($prg === false) {			
			$this->flashMessenger()->clearMessages();			
			// this wasn't a POST request, but there were no params in the flash messenger
			// probably this is the first time the form was loaded
			// Get params			
			$albumId = $this->getEvent()->getRouteMatch()->getParam('id');			
			if (!$albumId) {
				return $this->redirect()->toRoute($this->getOptions()->getRedirectRoute(), array('action'=>'index'));
			}
			// Get entity
			$album = $service->fetch($albumId);	
			$form->bind($album);						
			return array(
					'form' => $form,
					'redirect' => $redirect,					
			);								
		}
		
		// Form was submitted.
		// $prg is now an array containing the POST params from the previous request,
		// but we don't have to apply it to the form since that has already been done.
		$post = $prg;
		$form->setData($prg);
		if (!$form->isValid()) {			
			$this->flashMessenger()->addMessage('Please check the form errors.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		// Process the form
		$album=$form->getHydrator()->extract($form->getObject());
		$album = $service->delete($album);
		
		$redirect = isset($prg['redirect']) ? $prg['redirect'] : null;
		
		if (!$album) {
			$this->flashMessenger()->addErrorMessage('Oops... some error here.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		$this->flashMessenger()->addSuccessMessage('Album deleted correctly.');
		// TODO: Add the redirect parameter here...
		return $this->redirect()->toUrl($this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'index')) . ($redirect ? '?redirect='.$redirect : ''));
	}
	
	
	public function addAction()
	{
		// Start form, get things and read options, config and stuff
		$request = $this->getRequest();
		$service = $this->getServiceLocator()->get('Album\Service\AlbumService');
		$form = $this->getServiceLocator()->get('Album\Form\AlbumForm');
		
		if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
			$redirect = $request->getQuery()->get('redirect');
		} else {
			$redirect = false;
		}
		 
		// Pass in the route/url you want to redirect to after the POST
		$redirectUrl = $this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'add')).($redirect?'?redirect='.$redirect:'');
		$prg = $this->prg($redirectUrl, true);
		
		if ($prg instanceof Response) {
			// Returned a response to redirect us
			return $prg;
		} elseif ($prg === false) {
			$this->flashMessenger()->clearMessages();
			// this wasn't a POST request, but there were no params in the flash messenger
			// probably this is the first time the form was loaded
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		 
		// Form was submitted.
		// $prg is now an array containing the POST params from the previous request,
		// but we don't have to apply it to the form since that has already been done.
		$post = $prg;
		$form->setData($prg);
		if (!$form->isValid()) {
			$this->flashMessenger()->addMessage('Please check the form errors.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		// Process the form
		$album=$form->getHydrator()->extract($form->getObject());
		$album = $service->create($album);
		
		$redirect = isset($prg['redirect']) ? $prg['redirect'] : null;
		
		if (!$album) {
			$this->flashMessenger()->addErrorMessage('Oops... some error here.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		$this->flashMessenger()->addSuccessMessage('Album added correctly.');
		// TODO: Add the redirect parameter here...
		return $this->redirect()->toUrl($this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'index')) . ($redirect ? '?redirect='.$redirect : ''));		
	}
	
	
	public function editAction()
	{		
		// Start form, get things and read options, config and stuff
		$request = $this->getRequest();
		$service = $this->getServiceLocator()->get('Album\Service\AlbumService');		
		$form = $this->getServiceLocator()->get('Album\Form\AlbumForm');			
		 
		if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
			$redirect = $request->getQuery()->get('redirect');
		} else {
			$redirect = false;
		}
		
		// Pass in the route/url you want to redirect to after the POST
		$redirectUrl = $this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'edit')).($redirect?'?redirect='.$redirect:'');
		$prg = $this->prg($redirectUrl, true);		 
		
		if ($prg instanceof Response) {
			// Returned a response to redirect us
			return $prg;
		} elseif ($prg === false) {			
			$this->flashMessenger()->clearMessages();			
			// this wasn't a POST request, but there were no params in the flash messenger
			// probably this is the first time the form was loaded
			// Get params			
			$albumId = $this->getEvent()->getRouteMatch()->getParam('id');			
			if (!$albumId) {
				return $this->redirect()->toRoute($this->getOptions()->getRedirectRoute(), array('action'=>'index'));
			}
			// Get entity
			$album = $service->fetch($albumId);	
			$form->bind($album);						
			return array(
					'form' => $form,
					'redirect' => $redirect,					
			);								
		}
		
		// Form was submitted.
		// $prg is now an array containing the POST params from the previous request,
		// but we don't have to apply it to the form since that has already been done.
		$post = $prg;
		$form->setData($prg);
		if (!$form->isValid()) {			
			$this->flashMessenger()->addMessage('Please check the form errors.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		// Process the form
		$album=$form->getHydrator()->extract($form->getObject());
		$album = $service->update($album);
		
		$redirect = isset($prg['redirect']) ? $prg['redirect'] : null;
		
		if (!$album) {
			$this->flashMessenger()->addErrorMessage('Oops... some error here.');
			return array(
					'form' => $form,
					'redirect' => $redirect,
			);
		}
		
		$this->flashMessenger()->addSuccessMessage('Album modified correctly.');
		// TODO: Add the redirect parameter here...
		return $this->redirect()->toUrl($this->url()->fromRoute($this->getOptions()->getRedirectRoute(), array('action'=>'index')) . ($redirect ? '?redirect='.$redirect : ''));
	}
    
    /*********************************************** OPTIONS ********************************************/
	
	/**
	 * set options
	 *
	 * @param $options
	 * @return options
	 */
	public function setOptions($options)
	{
		$this->options = $options;
		return $this;
	}
	
	/**
	 * get options
	 *
	 * @return options
	 */
	public function getOptions()
	{
		if (!isset($this->options)) {
			$this->setOptions($this->getServiceLocator()->get('Album\Service\AlbumOptions'));
		}
		return $this->options;
	}
	
	
}
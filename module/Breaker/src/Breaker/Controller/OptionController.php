<?php

namespace Breaker\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Zend\View\Model\ViewModel;
use Breaker\Service\Option as OptionService;

class OptionController extends AbstractActionController
{
	const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
	const ROUTE_LOGIN        = 'zfcuser/login';
	const ROUTE_REGISTER     = 'zfcuser/register';
	const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';

	const CONTROLLER_NAME    = 'option';

	/**
	 * @var OptionService
	 */
	protected $optionService;

	/**
	 * @var Form
	 */
	protected $optionForm;


	/**
	 * User page
	 */
	public function indexAction()
	{   
	    $options = $this->getOptionService()->listOptions();
		return new ViewModel(array(
            'options' => $options,
        ));
	}	

	/**
	 * Getters/setters for DI stuff
	 */

	public function getOptionService()
	{
		if (!$this->optionService) {
			$this->optionService = $this->getServiceLocator()->get('breaker_option_service');
		}
		return $this->optionService;
	}

	public function setOptionService(OptionService $optionService)
	{
		$this->optionService = $optionService;
		return $this;
	}

	public function getOptionForm()
	{
		if (!$this->optionForm) {
			$this->setOptionForm($this->getServiceLocator()->get('breaker_option_form'));
		}
		return $this->optionForm;
	}

	public function setOptionForm(Form $optionForm)
	{
		$this->optionForm = $optionForm;
	}

}

<?php

namespace Breaker\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;
use ZfcBase\EventManager\EventProvider;
use Breaker\Mapper\OptionInterface as OptionMapperInterface;
use Breaker\Entity\Option as OptionEntity;


class Option extends EventProvider implements ServiceManagerAwareInterface
{

    /**
     * @var OptionMapperInterface
     */
    protected $optionMapper; 

    /**
     * @var Form
     */
    protected $optionForm;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;


    /**
     * @var Hydrator\ClassMethods
     */
    protected $formHydrator;

    /**
     * createFromForm
     *     
     * @return array<\ZfcUser\Entity\UserInterface>
     * @throws Exception\InvalidArgumentException
     */
    public function listOptions()
    {        
        $optionEntities  = array();       
        $hydrator = $this->getFormHydrator();
        $data = array();
        $data = $this->getOptionMapper()->fetchAll();
        foreach ($data as $option) {
            $optionEntity = new OptionEntity();
            $optionEntity = $hydrator->hydrate($option, $optionEntity);
            $optionEntities[] = $optionEntity;
        }
        return $optionEntities;
    }

    /**
     * getOptionMapper
     *
     * @return OptionMapperInterface
     */
    public function getOptionMapper()
    {
        if (null === $this->optionMapper) {
            $this->optionMapper = $this->getServiceManager()->get('option_mapper');
        }
        return $this->optionMapper;
    }

    /**
     * setOptionMapper
     *
     * @param OptionMapperInterface $optionMapper
     * @return Option
     */
    public function setOptionMapper(OptionMapperInterface $optionMapper)
    {
        $this->optionMapper = $optionMapper;
        return $this;
    } 

    /**
     * @return Form
     */
    public function getOptionForm()
    {
        if (null === $this->optionForm) {
            $this->optionForm = $this->getServiceManager()->get('breaker_option_form');
        }
        return $this->optionForm;
    }

    /**
     * @param Form $optionForm
     * @return Option
     */
    public function setOptionForm(Form $optionForm)
    {
        $this->optionForm = $optionForm;
        return $this;
    }    

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Option
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Return the Form Hydrator
     *
     * @return \Zend\Stdlib\Hydrator\ClassMethods
     */
    public function getFormHydrator()
    {
        if (!$this->formHydrator instanceof Hydrator\HydratorInterface) {
            $this->setFormHydrator($this->getServiceManager()->get('breaker_option_form_hydrator'));
        }

        return $this->formHydrator;
    }

    /**
     * Set the Form Hydrator to use
     *
     * @param Hydrator\HydratorInterface $formHydrator
     * @return Option
     */
    public function setFormHydrator(Hydrator\HydratorInterface $formHydrator)
    {
        $this->formHydrator = $formHydrator;
        return $this;
    }
}

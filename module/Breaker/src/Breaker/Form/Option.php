<?php

namespace Breaker\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class Option extends ProvidesEventsForm
{

    /**
     * @param string|null $name
     * @param RegistrationOptionsInterface $options
     */
    public function __construct($name = null)
    {       
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        
        $this->add(array(
        		'name' => 'idoption',
        		'attributes' => array(
        				'type'  => 'hidden',
        		),
        ));
        $this->add(array(
        		'name' => 'name',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Name',
        		),
        ));
        $this->add(array(
        		'name' => 'color',
        		'attributes' => array(
        				'type'  => 'color',
        		),
        		'options' => array(
        				'label' => 'Color',
        		),
        ));
        
        $this->add(array(
        		'name' => 'hashtag',
        		'attributes' => array(
        				'type'  => 'text',
        		),
        		'options' => array(
        				'label' => 'Hashtag',
        		),
        ));
        
        $this->get('submit')->setLabel('Submit');
        $this->getEventManager()->trigger('init', $this);
    }
}

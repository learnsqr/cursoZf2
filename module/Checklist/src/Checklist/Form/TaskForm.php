<?php
namespace Checklist\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class TaskForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('task');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new TaskFilter());
        $this->setHydrator(new ClassMethods());

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'text',
            'options' => array(
                'label' => 'Title',
            ),
            'attributes' => array(
                'id' => 'title',
                'maxlength' => 100,
            )
        ));

        $this->add(array(
            'name' => 'completed',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Completed?',
                'label_attributes' => array('class'=>'checkbox'),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-primary',
            ),
        ));
    }
}
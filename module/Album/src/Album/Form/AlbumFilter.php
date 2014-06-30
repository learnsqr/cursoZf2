<?php

namespace Album\Form;

use Zend\InputFilter\InputFilter;


class AlbumFilter extends InputFilter
{
 	
    public function __construct()
    {
    	$this->add(array(
						'name' => 'title',
						'required' => true,
						'filters' => array(
								0 => array(
										'name' => 'Zend\\Filter\\StringTrim',
										'options' => array(),
								),
								1 => array(
										'name' => 'Zend\\Filter\\StripTags',
										'options' => array(),
								),
						),
						'validators' => array(
								0 => array(
										'name' => 'Zend\\Validator\\StringLength',
										'options' => array(
												'max' => '100',
										),
								),
						),
						'description' => 'Title of this album',
				));    	    	
    
    	$this->add(array(
						'name' => 'artist',
						'required' => true,
						'filters' => array(
								0 => array(
										'name' => 'Zend\\Filter\\StringTrim',
										'options' => array(),
								),
								1 => array(
										'name' => 'Zend\\Filter\\StripTags',
										'options' => array(),
								),
						),
						'validators' => array(
								0 => array(
										'name' => 'Zend\\Validator\\StringLength',
										'options' => array(
												'max' => '100',
										),
								),
						),
						'description' => 'Artist who made this album!',
				));    
    	
    }    
        
}


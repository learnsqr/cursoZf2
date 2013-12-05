<?php

namespace Breaker\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements    
    BreakerControllerOptionsInterface
{
	
	/**
	 * @var int
	 */
	protected $someVarHere = 1;
	
	/**
	 * @var string
	 */	
	protected $tableName = 'table_name';
		
		
	/**
	 * get some var here
	 *
	 * @return string
	 */
	public function getSomeVarHere(){
		return $this->someVarHere;
	}
	
	/**
	 * set some var here
	 *
	 * @param string $someVarHere
	 */
	public function setSomeVarHere($someVarHere){
		$this->someVarHere=$someVarHere;
	}
	
	/**
	 * get user table name
	 *
	 * @return string
	 */
	public function getTableName(){
		return $this->tableName;
	}
	
	/**
	 * set user table name
	 *
	 * @param string $tableName
	 */
	public function setTableName($tableName){
		$this->tableName=$tableName;
	}
	
	/**
	 * get user table name
	 *
	 * @return string
	 */
	public function getTableName(){
		return $this->tableName;
	}
	
	
}

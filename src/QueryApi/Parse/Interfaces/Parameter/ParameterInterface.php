<?php 
namespace QueryApi\Parse\Interfaces\Parameter;

interface ParameterInterface 
{

	/**
	 * getName get name field
	 * @return string
	 */
	public function getName();

	/**
	 * set name value
	 * @param string $name name of column in clausule
	 */
	public function setName($name);
	
}
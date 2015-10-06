<?php 
namespace QueryApi\Parse\Interfaces\Validator;

use QueryApi\Parse\Interfaces\Parameter\ParameterInterface;

interface ValidatorInterface
{

	/**
	 * Valid operator of clausule
	 * @param  String $operator 
	 * @return boolean          is valid or not
	 */
	public function isValid(ParameterInterface $parameter);


}
<?php 
namespace QueryApi\Parse\Validator;

use QueryApi\Parse\Interfaces\Validator\ValidatorInterface;
use QueryApi\Parse\Interfaces\Parameter\ParameterInterface;

class OrderByValidator implements ValidatorInterface
{
	/**
	 * Operator to the query strings
	 */
	const OPERATOR = [
		'DESC',
		'ASC'
 	]; 
	
	public function isValid(ParameterInterface $parameter)
 	{
 		$this->validValue($parameter->getValue());
 	}	

	/**
	 * Valid value of clausule
	 * @param  String $validValue 
	 * @return boolean          is valid or not
	 */
	public function validValue($value)
	{
		$key = array_search($value, OrderByValidator::OPERATOR);

		if (! is_int($key) && ! $key)
			throw new \InvalidArgumentException('operator '.$value.' invalid');

		return true;
	}

}
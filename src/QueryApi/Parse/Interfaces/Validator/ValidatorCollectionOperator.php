<?php 
namespace QueryApi\Parse\Interfaces\Validator;

interface ValidatorCollectionOperator extends ValidatorInterface
{
	/**
	 * Valid value of clause according operator
	 * @param  String $operator 
	 * @param  String $value    
	 * @return boolean          is valid or not
	 */
	public function validValue($operator, $value);

	/**
	 * Valid operator of clausule
	 * @param  String $operator 
	 * @return boolean          is valid or not
	 */
	public function validOperator($operator);
	
}
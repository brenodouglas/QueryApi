<?php 
namespace QueryApi\Parse\Validator;

use QueryApi\Parse\Interfaces\Validator\ValidatorCollectionOperator,
	QueryApi\Parse\Interfaces\Parameter\ParameterInterface,
    QueryApi\Parse\Clausules\Where;

class WhereValidator implements ValidatorCollectionOperator
{
	/**
	 * Operator to the query strings
	 */
	public static $operator = [
		'eq'     => '=',
		'neq'    => '<>',
		'lt'     => '<',
		'lte'    => '<=',
		'gt'     => '>',
		'get'    => '>=',
		'like'      => 'LIKE'
 	]; 

 	public static $especial_operator = [
 		'isNull'    => 'whereNull',
		'isNotNull' => "whereNotNull",
		'between'   => 'whereBetween',
		'in'        => 'whereIn'
 	];

 	public function isValid(ParameterInterface $parameter)
 	{
 		$this->validOperator($parameter->getOperator());
 		$this->validValue($parameter->getOperatorValue(), $parameter->getValue());
 	}	

	public function validValue($operator, $value)
	{
		switch ($operator) {
			case WhereValidator::$operator['eq']:
			case WhereValidator::$operator['neq']:
			case WhereValidator::$operator['lt']:
			case WhereValidator::$operator['lte']:
			case WhereValidator::$operator['gt']:
			case WhereValidator::$operator['like']:   
			case WhereValidator::$operator['get']:
				if(! is_string($value) && ! is_numeric($value) && ! is_int($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.json_encode($value));
				break;
			case WhereValidator::$especial_operator['isNull']:
				if(! is_bool($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.$value);
				break;
			case WhereValidator::$especial_operator['between']:
				if(! is_array($value) || count($value) != 2)
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
				break;
			case WhereValidator::$especial_operator['in']:
				if(! is_array($value) || count($value) < 2)
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
				break;
			default:
				throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
		}

		return true;
	}

	public function validOperator($operator)
	{
		if( ! array_key_exists($operator, WhereValidator::$operator) && ! array_key_exists($operator, WhereValidator::$especial_operator))
			throw new \InvalidArgumentException('Operator '.$operator.' not exists');

		return true;
	}

}
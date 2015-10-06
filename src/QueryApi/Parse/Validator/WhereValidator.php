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
	const OPERATOR = [
		'eq'     => '=',
		'neq'    => '<>',
		'lt'     => '<',
		'lte'    => '<=',
		'gt'     => '>',
		'get'    => '>=',
		'like'      => 'LIKE'
 	]; 

 	const ESPECIAL_OPERATORS = [
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
			case WhereValidator::OPERATOR['eq']:
			case WhereValidator::OPERATOR['neq']:
			case WhereValidator::OPERATOR['lt']:
			case WhereValidator::OPERATOR['lte']:
			case WhereValidator::OPERATOR['gt']:
			case WhereValidator::OPERATOR['like']:   
			case WhereValidator::OPERATOR['get']:
				if(! is_string($value) && ! is_numeric($value) && ! is_int($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.json_encode($value));
				break;
			case WhereValidator::ESPECIAL_OPERATORS['isNull']:
				if(! is_bool($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.$value);
				break;
			case WhereValidator::ESPECIAL_OPERATORS['between']:
				if(! is_array($value) || count($value) != 2)
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
				break;
			case WhereValidator::ESPECIAL_OPERATORS['in']:
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
		if( ! array_key_exists($operator, WhereValidator::OPERATOR) && ! array_key_exists($operator, WhereValidator::ESPECIAL_OPERATORS))
			throw new \InvalidArgumentException('Operator '.$operator.' not exists');

		return true;
	}

}
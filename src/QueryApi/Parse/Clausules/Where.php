<?php 
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Interfaces\WhereParameterInterface;

class Where implements WhereParameterInterface 
{

	private $value;

	private $operator;

	private $name;

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

	/**
	 * Construct where clausule for SQL
	 * @param [type] $name     [Fiel database name]
	 * @param [type] $operator [operator in where clausule]
	 * @param [type] $value    [value for comparator in where clausule]
	 */
	public function __construct($name = null, $operator = null, $value = null)
	{
		if($operator != null && $name != null && $value != null) {
			$this->validOperator($operator);
			$operatorAux = array_key_exists($operator, Where::OPERATOR) ?  Where::OPERATOR[$operator] : Where::ESPECIAL_OPERATORS[$operator];

			$this->validValue($operatorAux, $value);
		}
		
		$this->name = $name;
		$this->operator = $operator;
		$this->value = $value;
	}

	/**
	 * [extractInArray extract clauses for where in array]
	 * @param  array  $where [ pattern to the array: ['fieldName' => ['operator' => 'value']] ]
	 * @return void
	 */
	public function extractInArray(array $where)
	{
		$this->name = key($where);
		$this->operator = key($where[$this->name]);
		$this->value = $where[$this->name][$this->operator];

		$this->validOperator($this->operator);
		$this->validValue($this->operator, $this->value);
	}

	/**
	 * [getName get name field]
	 * @return [string] 
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * [getName get value]
	 * @return [string] 
	 */
	public function getValue()
	{
		return is_bool($this->value) ? null : $this->value;
	}

	/**
	 * getName get operator where
	 * @return [string] 
	 */
	public function getOperator()
	{
		return $this->operator;
	}

	/**
	 * getName get operator where value
	 * @return [string] 
	 */
	public function getOperatorValue()
	{
		if(array_key_exists($this->operator, Where::ESPECIAL_OPERATORS))
			return Where::ESPECIAL_OPERATORS[$this->operator];

		return Where::OPERATOR[$this->operator];
	}

	/**
	 * Valid operator passed for Where
	 * @param  string $operator valid operator in Where::OPERATOR
	 */
	private function validOperator($operator)
	{
		if( ! array_key_exists($operator, Where::OPERATOR) && ! array_key_exists($operator, Where::ESPECIAL_OPERATORS))
			throw new \InvalidArgumentException('Operator '.$operator.' not exists');
	}

	/**
	 * Valid value acoording operator
	 * @param  [type] $operator [description]
	 * @param  [type] $value    [description]
	 * @return [type]           [description]
	 */
	private function validValue($operator, $value)
	{
		switch ($operator) {
			case Where::OPERATOR['eq']:
			case Where::OPERATOR['neq']:
			case Where::OPERATOR['lt']:
			case Where::OPERATOR['lte']:
			case Where::OPERATOR['gt']:
			case Where::OPERATOR['like']:   
			case Where::OPERATOR['get']:
				if(! is_string($value) && ! is_numeric($value) && ! is_int($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.json_encode($value));
				break;
			case Where::ESPECIAL_OPERATORS['isNull']:
				if(! is_bool($value))
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '.$value);
				break;
			case Where::ESPECIAL_OPERATORS['between']:
				if(! is_array($value) || count($value) != 2)
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
				break;
			case Where::ESPECIAL_OPERATORS['in']:
				if(! is_array($value) || count($value) < 2)
					throw new \InvalidArgumentException('Operator '.$operator.' not expected '. is_array($value) ? json_encode($value) : $value);
				break;
		}
	}

}
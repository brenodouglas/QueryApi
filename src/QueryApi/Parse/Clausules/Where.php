<?php 
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Interfaces\Parameter\CollectionParameterInterface;
use QueryApi\Parse\Validator\WhereValidator;
use QueryApi\Parse\Interfaces\ValidatorOperator;

class Where implements CollectionParameterInterface 
{
	private $value;

	private $operator;

	private $name;

	private $validator;

	/**
	 * Construct where clausule for SQL
	 * @param [type] $name     [Fiel database name]
	 * @param [type] $operator [operator in where clausule]
	 * @param [type] $value    [value for comparator in where clausule]
	 */
	public function __construct($name = null, $operator = null, $value = null)
	{
		$this->validator = new WhereValidator();

		if($operator != null && $name != null && $value != null) {
			$this->name = $name;
			$this->operator = $operator;
			$this->value = $value;

			$this->validator->isValid($this);
		}
		
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

		$this->validator->isValid($this);
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
	 * get value of clausule
	 * @return string|boolean|number
	 */
	public function getValue()
	{
		return $this->value;
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
		if(array_key_exists($this->operator, WhereValidator::$especial_operator))
			return WhereValidator::$especial_operator[$this->operator];

		return WhereValidator::$operator[$this->operator];
	}

	public function setValidator(ValidatorOperator $validator)
	{
		$this->validator = $validator;
	}

		/**
	 * setName set name field
	 * @return string
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * setValue set value 
	 * @return string]
	 */
	public function setValue($value)
	{
		$this->validator->validValue($this->operator, $value);

		$this->value = $value;
	}

	/**
	 * setOperator set operator where
	 * @return string
	 */
	public function setOperator($operator)
	{
		$this->validator->validOperator($operator);

		$this->operator = $operator;
	}

}
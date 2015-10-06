<?php
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Validator\OrderByValidator;
use QueryApi\Parse\Interfaces\Parameter\KeyValueParameterInterface;
use QueryApi\Parse\Interfaces\Validator\ValidatorInteface;

class OrderBy implements KeyValueParameterInterface
{
	private $name;

	private $value;

	private $validator;

	/**
	 * Construct clausule for SQL
	 * @param String $name     Fiel database name
	 * @param String $operator operator in clausule
	 * @param String $value    value for comparator in clause
	 */
	public function __construct($name = null, $value = null)
	{
		$this->validator = new OrderByValidator();

		if($name != null && $value != null) {
			$this->name = $name;
			$this->value = $value;

			$this->validator->isValid($this);
		}
		
	}

	/**
	 * extractInArray extract clauses in array
	 * @param  array  $where  pattern to the array: ['id' => 'DESC']] 
	 * @return void
	 */
	public function extractInArray(array $array)
	{
		$this->name = key($array);
		$this->value = $array[$this->name];

		$this->validator->isValid($this);
	}
	
	/**
	 * getName get value
	 * @return string]
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * setValue set value 
	 * @return string]
	 */
	public function setValue($value)
	{
		$this->value = $value;
		$this->validator->isValid($this);
	}

	/**
	 * getName get name field
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * set name value
	 * @param string $name name of column in clausule
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	public function setValidator(ValidatorInteface $validator)
	{
		$this->validator = $validator;
	}	
}
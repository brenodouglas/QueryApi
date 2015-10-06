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

	public function __construct($name = null, $value = null)
	{
		$this->validator = new OrderByValidator();

		if($name != null && $value != null) {
			$this->name = $name;
			$this->value = $value;

			$this->validator->isValid($this);
		}
		
	}

	public function extractInArray(array $array)
	{
		$this->name = key($array);
		$this->value = $array[$this->name];

		$this->validator->isValid($this);
	}
	
	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
		$this->validator->isValid($this);
	}

	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}

	public function setValidator(ValidatorInteface $validator)
	{
		$this->validator = $validator;
	}	
}
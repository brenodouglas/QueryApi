<?php 
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Interfaces\Parameter\UniqueParameterInterface;

class GroupBy implements UniqueParameterInterface
{
	private $value;

	public function __construct($value = null)
	{
		if(! is_string($value))
			throw new \InvalidArgumentException('Value'. $value . ' is not valid string');

		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		if(! is_string($value))
			throw new \InvalidArgumentException('Value'. $value . ' is not valid string');

		$this->value = $value;
	}
}
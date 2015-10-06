<?php 
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Interfaces\Parameter\UniqueParameterInterface;
use QueryApi\Parse\Interfaces\Queriable;
use Illuminate\Database\Query\Builder;

class Offset implements UniqueParameterInterface, Queriable
{
	private $value;

	public function __construct($value = null)
	{
		if(! is_int($value))
			throw new \InvalidArgumentException('Value'. $value . ' is not integer number');

		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		if(! is_int($value))
			throw new \InvalidArgumentException('Value' . $value . ' is not integer number');

		$this->value = $value;
	}

	public function execute(Builder $query)
	{
		$query->skip($this->getValue());
		return $query;
	}

}
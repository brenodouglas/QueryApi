<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\ClausuleCollectionInterface;
use QueryApi\Parse\Interfaces\Parameter\ParameterInterface;
use QueryApi\Parse\Interfaces\Queriable;

use Illuminate\Database\Query\Builder;

abstract class AbstractCollection implements ClausuleCollectionInterface
{

	protected $values = [];

	protected $current = 0;

	public function count() 
	{
		return count($this->values);
	}

	protected function getValuesIterator() 
	{
		foreach ($this->values as $value) 
			yield $value;
	}

	public function append(ParameterInterface $where)
	{
		$this->next();
		$this->values[$this->current] = $where;
	}

	public function current() 
	{
		return $this->values[$this->current];
	}
	
	public function next() 
	{
		$this->current += 1;
	}
	
	public function rewind() 
	{
		$this->current = 0;
	}
	
	public function key() 
	{
		return $this->current;
	}
	
	public function valid() 
	{
		return isset($this->keys[$this->current]);
	}
}
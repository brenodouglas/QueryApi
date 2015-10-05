<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\WhereCollectionInterface;
use QueryApi\Parse\Clausules\Where;
use Illuminate\Database\Query\Builder;

class WhereCollection implements WhereCollectionInterface
{

	private $values = [];

	private $current = 0;


	public function count() 
	{
		return count($this->values);
	}

	/**
	 * [getValues description]
	 * @return [Where] 
	 */
	private function getValuesIterator() 
	{
		foreach ($this->values as $value) 
			yield $value;
	}

	/**
	 * Execute query with where parameters
	 * @param  Builder $query
	 * @return Builder $query 
	 * */
	public function execute(Builder $query)
	{
		$isWhere = false;
		$count = 0;

		foreach($this->getValuesIterator() as $where):
		
			$operator = $where->getOperator();
				
			if ( array_key_exists($operator, Where::ESPECIAL_OPERATORS)) {
				
				$method = $where->getOperatorValue();

				switch ($method):
					case Where::ESPECIAL_OPERATORS['isNull']:
					case Where::ESPECIAL_OPERATORS['isNotNull']:
						$query->$method($where->getName());
						break;
					case Where::ESPECIAL_OPERATORS['between']:
					case Where::ESPECIAL_OPERATORS['in']:
						$query->$method($where->getName(), $where->getValue());
						break;
				endswitch;

				continue;
			} else if ( $where->getOperatorValue() == Where::OPERATOR['like'] ) {
				$value = '%'.$where->getValue().'%';
			} else { 
				$value = $where->getValue();
			}

			$query->where($where->getName(), $where->getOperatorValue(), $value);

		endforeach;

		return $query;
	}

	/**
	 * Append Where object in collection
	 * @param  Where  $where [description]
	 */
	public function append(Where $where)
	{
		$this->next();
		$this->values[$this->current] = $where;
	}

	/**
	 * [current description]
	 * @return [Where] [Where clausule]
	 */
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
<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\WhereCollectionInterface;
use QueryApi\Parse\Clausules\Where;

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
	public function execute($query)
	{
		$isWhere = false;
		$count = 0;

		foreach($this->getValuesIterator() as $where) 
		{
			$operator = $where->getOperator();

			if (! $isWhere) {
				
				if( $where->getOperator() == 'isNull') {

					$count > 0 ? $query->andWhereIsNull($where->getName(), $where->getOperatorValue()) :
								 $query->whereIsNull($where->getName(), $where->getOperatorValue());
				
				} else if ( $where->getOperatorValue() == Where::OPERATOR['like'] ) {
				
					$count > 0 ? $query->andWhere($where->getName(), $where->getOperatorValue(), '%'.$where->getValue().'%') : 
								 $query->where($where->getName(), $where->getOperatorValue(), '%'.$where->getValue().'%');
				
				} else { 
					$count > 0 ? $query->andWhere($where->getName(), $where->getOperatorValue(), $where->getValue()) : 
								 $query->where($where->getName(), $where->getOperatorValue(), $where->getValue());
				}

				$isWhere = true;
				
				$count++;

				continue;
			} 

			if( $where->getOperator() == 'isNull' ) {

				$count > 0 ? $query->andWhereIsNull($where->getName(), $where->getOperatorValue()) :
							 $query->whereIsNull($where->getName(), $where->getOperatorValue());
			
			} else if ( $where->getOperatorValue() == Where::OPERATOR['like'] ) {
			
				$count > 0 ? $query->andWhere($where->getName(), $where->getOperatorValue(), '%'.$where->getValue().'%') : 
							 $query->where($where->getName(), $where->getOperatorValue(), '%'.$where->getValue().'%');
			
			} else { 
				$count > 0 ? $query->andWhere($where->getName(), $where->getOperatorValue(), $where->getValue()) : 
							 $query->where($where->getName(), $where->getOperatorValue(), $where->getValue());
			}

			$count++;
		}

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
<?php
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\ClausuleCollectionInterface;
use QueryApi\Parse\Interfaces\Queriable;

use Illuminate\Database\Query\Builder;

class OrderByCollection extends AbstractCollection implements Queriable
{

	public function execute(Builder $query)
	{
		foreach($this->getValuesIterator() as $orderBy)
			$query->orderBy($orderBy->getName(), $orderBy->getValue());

		return $query;
	}

}
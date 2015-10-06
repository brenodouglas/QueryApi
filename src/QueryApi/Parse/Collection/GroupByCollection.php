<?php
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\ClausuleCollectionInterface;
use QueryApi\Parse\Interfaces\Queriable;

use Illuminate\Database\Query\Builder;

class GroupByCollection extends AbstractCollection implements Queriable
{

	public function execute(Builder $query)
	{

		foreach($this->getValuesIterator() as $groupBy)
			$query->groupBy($groupBy->getValue());

		return $query;
	}

}
<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Interfaces\ClausuleCollectionInterface;

use QueryApi\Parse\Interfaces\Queriable;
use QueryApi\Parse\Clausules\Where;
use QueryApi\Parse\Validator\WhereValidator;

use Illuminate\Database\Query\Builder;

class WhereCollection extends AbstractCollection implements Queriable
{

	public function execute(Builder $query)
	{
		$isWhere = false;
		$count = 0;

		foreach($this->getValuesIterator() as $where):
		
			$operator = $where->getOperator();
				
			if ( array_key_exists($operator, WhereValidator::$especial_operator)) {
				
				$method = $where->getOperatorValue();

				switch ($method):
					case WhereValidator::$especial_operator['isNull']:
					case WhereValidator::$especial_operator['isNotNull']:
						$query->$method($where->getName());
						break;
					case WhereValidator::$especial_operator['between']:
					case WhereValidator::$especial_operator['in']:
						$query->$method($where->getName(), $where->getValue());
						break;
				endswitch;

				continue;
			} else if ( $where->getOperatorValue() == WhereValidator::$operator['like'] ) {
				$value = '%'.$where->getValue().'%';
			} else { 
				$value = $where->getValue();
			}

			$query->where($where->getName(), $where->getOperatorValue(), $value);

		endforeach;

		return $query;
	}

}
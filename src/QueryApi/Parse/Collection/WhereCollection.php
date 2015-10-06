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
				
			if ( array_key_exists($operator, WhereValidator::ESPECIAL_OPERATORS)) {
				
				$method = $where->getOperatorValue();

				switch ($method):
					case WhereValidator::ESPECIAL_OPERATORS['isNull']:
					case WhereValidator::ESPECIAL_OPERATORS['isNotNull']:
						$query->$method($where->getName());
						break;
					case WhereValidator::ESPECIAL_OPERATORS['between']:
					case WhereValidator::ESPECIAL_OPERATORS['in']:
						$query->$method($where->getName(), $where->getValue());
						break;
				endswitch;

				continue;
			} else if ( $where->getOperatorValue() == WhereValidator::OPERATOR['like'] ) {
				$value = '%'.$where->getValue().'%';
			} else { 
				$value = $where->getValue();
			}

			$query->where($where->getName(), $where->getOperatorValue(), $value);

		endforeach;

		return $query;
	}

}
<?php
namespace QueryApi\Parse\Interfaces;

use QueryApi\Parse\Interfaces\Parameter\ParameterInterface;
use Illuminate\Database\Query\Builder;

/**
 * Collection with parameter for Query
 */
interface ClausuleCollectionInterface extends \Iterator, \Countable
{

	/**
	 * Append Parater object in collection
	 * @param  ParameterInterface  $parameter    
	 */
	public function append(ParameterInterface $parameter);
	
}
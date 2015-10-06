<?php
namespace QueryApi\Parse\Interfaces;

use QueryApi\Parse\Clausules\Where;
use Illuminate\Database\Query\Builder;


/**
 * Collection with Where parameter for Query
 */
interface WhereCollectionInterface extends \Iterator, \Countable
{

	/**
	 * Append Where object in collection
	 * @param  Where  $where    
	 */
	public function append(Where $where);
	
}
<?php
namespace QueryApi\Parse\Interfaces;

use Illuminate\Database\Query\Builder;
use QueryApi\Parse\Clausules\Where;


/**
 * Collection with Where parameter for Query
 */
interface WhereCollectionInterface extends Iterator
{

	/**
	 * Execute query with where parameters
	 * @param  Builder $query [description]
	 * @return Builder $query [description]
	 */
	public function executeQuery(Builder $query);

	/**
	 * Append Where object in collection
	 * @param  Where  $where [description]
	 * @return [type]        [description]
	 */
	public function append(Where $where);
	
}
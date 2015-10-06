<?php 
namespace QueryApi\Parse\Interfaces;

use Illuminate\Database\Query\Builder;

interface Queriable
{
    /**
	 * Execute query with where parameters
	 * @param  Builder $query 
	 * @return Builder $query 
	 */
	public function execute(Builder $query);
	
}
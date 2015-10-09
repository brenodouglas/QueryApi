<?php 
namespace QueryApi\Parse\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use QueryApi\Parse\Http\RequestParamsCollection;

abstract class AbstractModel extends Model
{

	public function scopeApi(Builder $query, RequestParamsCollection $params)
	{
		//TODO implements this method

		return $query;
	}
}
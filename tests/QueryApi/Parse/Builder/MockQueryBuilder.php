<?php 
namespace QueryApi\Parse\Builder;

use PHPUnit_Framework_TestCase as PHPUnit;

class MockQueryBuilder 
{

	public function buildMock(PHPUnit $phpunit)
	{
		return $phpunit->getMockBuilder('Illuminate\Database\Query\Builder')
						  ->setMethods([
						  		'where', 
						  		'whereNull', 
						  		'whereNotNull', 
						  		'whereBetween', 
						  		'whereNotBetween', 
						  		'whereIn', 
						  		'whereNotIn',
						  		'groupBy',
						  		'take',
						  		'skip',
						  		'orderBy'
				  			])
						  ->getMock();
	}

}
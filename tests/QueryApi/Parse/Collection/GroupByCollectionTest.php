<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Collection\GroupByCollection,
	QueryApi\Parse\Clausules\GroupBy,
	QueryApi\Parse\Test\Query,
	QueryApi\Parse\Builder\MockQueryBuilder;

use PHPUnit_Framework_TestCase as PHPUnit;

class GroupByCollectionTest extends PHPUnit
{
	public function test_create_collection_with_groupBy() 
	{
		$mockQuery = (new MockQueryBuilder())->buildMock($this);

		$mockQuery->expects($this->once())
				  ->method('groupBy')
				  ->with(
				  		$this->equalTo('id')
			  	  );

		$collection = new GroupByCollection();
		$groupBy = new GroupBy('id');

		$collection->append($groupBy);

		$this->assertCount(1, $collection);
		
		$query = $collection->execute($mockQuery);
		$this->assertInstanceOf('Illuminate\Database\Query\Builder', $query);
	}
}
<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Collection\OrderByCollection,
	QueryApi\Parse\Clausules\OrderBy,
	QueryApi\Parse\Test\Query,
	QueryApi\Parse\Builder\MockQueryBuilder;

use PHPUnit_Framework_TestCase as PHPUnit;

class OrderByCollectionTest extends PHPUnit
{
	public function test_create_collection_with_orderby() 
	{
		$mockQuery = (new MockQueryBuilder())->buildMock($this);

		$mockQuery->expects($this->once())
				  ->method('orderBy')
				  ->with(
				  		$this->equalTo('id'), 
				  		$this->equalTo('DESC')
			  	  );

		$collection = new OrderByCollection();
		$orderBy = new OrderBy('id', 'DESC');

		$collection->append($orderBy);

		$this->assertCount(1, $collection);

		$query = $collection->execute($mockQuery);
		$this->assertInstanceOf('Illuminate\Database\Query\Builder', $query);
	}
}
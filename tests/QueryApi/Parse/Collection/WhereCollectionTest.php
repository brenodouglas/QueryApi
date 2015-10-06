<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Collection\WhereCollection,
	QueryApi\Parse\Clausules\Where,
	QueryApi\Parse\Test\Query,
	QueryApi\Parse\Builder\MockQueryBuilder;

use PHPUnit_Framework_TestCase as PHPUnit;

class WhereCollectionTest extends PHPUnit
{
	public function test_create_collection_with_two_where() 
	{

		$mockQuery = (new MockQueryBuilder())->buildMock($this);

		$mockQuery->expects($this->once())
				  ->method('where')
				  ->with(
				  		$this->equalTo('id'), 
				  		$this->equalTo('='),
				  		$this->equalTo(1)	
			  	  );

  	    $mockQuery->expects($this->once())
  	              ->method('whereNull')
  	              ->with(
  	              		$this->equalTo('nome')
  	              );

		$collection = new WhereCollection();
		$whereOne = new Where('id', 'eq', 1);
		$whereTwo = new Where('nome', 'isNull', true);

		$collection->append($whereOne);
		$collection->append($whereTwo);

		$this->assertCount(2, $collection);

		$query = $collection->execute($mockQuery);
		$this->assertInstanceOf('Illuminate\Database\Query\Builder', $query);
	}
}
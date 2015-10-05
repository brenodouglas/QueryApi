<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Collection\WhereCollection,
	QueryApi\Parse\Clausules\Where,
	QueryApi\Parse\Test\Query;

use PHPUnit_Framework_TestCase as PHPUnit;

class WhereCollectionTest extends PHPUnit
{

	public function test_create_collection_with_two_where() 
	{

		$mockQuery = $this->getMockQuery();

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
	}

	private function getMockQuery()
	{
		return $this->getMockBuilder('Illuminate\Database\Query\Builder')
						  ->setMethods([
						  		'where', 
						  		'whereNull', 
						  		'whereNotNull', 
						  		'whereBetween', 
						  		'whereNotBetween', 
						  		'whereIn', 
						  		'whereNotIn'
				  			])
						  ->getMock();
	}
}
<?php 
namespace QueryApi\Parse\Collection;

use QueryApi\Parse\Collection\WhereCollection,
	QueryApi\Parse\Clausules\Where,
	QueryApi\Parse\Test\Query;

use PHPUnit_Framework_TestCase as PHPUnit;

class WhereCollectionTest extends PHPUnit
{

	public function testCreateCollectionWithTwoWhere() 
	{
		$queryMock = new Query();

		$collection = new WhereCollection();
		$whereOne = new Where('id', 'eq', 'name');
		$whereTwo = new Where('nome', 'isNull', true);

		$collection->append($whereOne);
		$collection->append($whereTwo);

		$this->assertCount(2, $collection);

		$query = $collection->execute($queryMock);

		$this->assertEquals('WHERE id = :id AND nome IS NULL ', $query->getQuery());
		$this->assertCount(2, $query->getParameters());
	}

}
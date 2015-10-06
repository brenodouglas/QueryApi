<?php
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Clausules\Limit;
use QueryApi\Parse\Builder\MockQueryBuilder;

use PHPUnit_Framework_TestCase as PHPUnit;

class LimitTest extends PHPUnit
{

	public function test_create_basic_limit()
	{
		$limit = new Limit(2);
		$this->assertEquals(2, $limit->getValue());
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_create_basic_limit_ivalid_arugment()
	{
		$limit = new Limit('fdsa');
	}

	public function teste_create_basic_limit_execute_query()
	{

		$mockQuery = (new MockQueryBuilder())->buildMock($this);

		$mockQuery->expects($this->once())
				  ->method('take')
				  ->with(
				  		$this->equalTo(2)	
			  	  );

		$limit = new Limit(2);
		$this->assertEquals(2, $limit->getValue());

		$query = $limit->execute($mockQuery);
		$this->assertInstanceOf('Illuminate\Database\Query\Builder', $query);
	}
}

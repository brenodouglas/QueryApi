<?php
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Clausules\Offset;
use QueryApi\Parse\Builder\MockQueryBuilder;

use PHPUnit_Framework_TestCase as PHPUnit;

class OffsetTest extends PHPUnit
{

	public function test_create_basic_offset()
	{
		$offset = new Offset(2);
		$this->assertEquals(2, $offset->getValue());
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_create_basic_offset_ivalid_arugment()
	{
		$offset = new Offset('fdsa');
	}

	public function teste_create_basic_offset_execute_query()
	{

		$mockQuery = (new MockQueryBuilder())->buildMock($this);

		$mockQuery->expects($this->once())
				  ->method('skip')
				  ->with(
				  		$this->equalTo(10)	
			  	  );

		$offset = new Offset(10);
		$this->assertEquals(10, $offset->getValue());

		$query = $offset->execute($mockQuery);
		$this->assertInstanceOf('Illuminate\Database\Query\Builder', $query);
	}
}

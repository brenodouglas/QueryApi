<?php
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Clausules\Where,
	QueryApi\Parse\Clausules\InvalidArgumentException;

use PHPUnit_Framework_TestCase as PHPUnit;

class WhereTest extends PHPUnit
{

	public function testCreateWhere()
	{
		$where = new Where('id', 'lt', 2);
		$where2 = new Where('id', 'eq', 7);

		$this->assertEquals('<', $where->getOperatorValue());
		$this->assertEquals('id', $where->getName());
		$this->assertEquals(2, $where->getValue());

		$this->assertEquals('=', $where2->getOperatorValue());
		$this->assertEquals('id', $where2->getName());
		$this->assertEquals(7, $where2->getValue());
	}

	public function testExtractArrayWithIsNullOperator()
	{
		$where = new Where();
		$where->extractInArray(['id' => ['isNull' => true]]);

		$this->assertEquals('IS NULL', $where->getOperatorValue());
		$this->assertEquals('id', $where->getName());
		$this->assertNull($where->getValue());
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testCreateWhereWithInvalidOperator()
	{
		$where = new Where('id', 'xxx', 2);
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testExtractArrrayWithInvalidOperator()
	{
		$where = new Where();
		$where->extractInArray(['id' => ['xxx' => true]]);
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testCreateWhereWithInvalidValueExpectedUnique()
	{
		$where = new Where('id', 'eq', [1, 2, 3]);
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testCreateWhereWithInvalidValueExpectedArrayTwoPosition()
	{
		$where = new Where('id', 'between', [1, 2, 3]);
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testCreateWhereWithInvalidValueExpectedBoolean()
	{
		$where = new Where('id', 'isNull', 3);
	}
}
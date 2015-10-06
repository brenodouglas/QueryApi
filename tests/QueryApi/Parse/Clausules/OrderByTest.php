<?php
namespace QueryApi\Parse\Clausules;

use QueryApi\Parse\Clausules\OrderBy;
use PHPUnit_Framework_TestCase as PHPUnit;

class OrderByTest extends PHPUnit
{

	public function test_create_basic_orderby()
	{
		$orderBy = new OrderBy('id', 'DESC');
		$orderBy2 = new OrderBy('name', 'ASC');

		$this->assertEquals('id', $orderBy->getName());
		$this->assertEquals('DESC', $orderBy->getValue());

		$this->assertEquals('name', $orderBy2->getName());
		$this->assertEquals('ASC', $orderBy2->getValue());
	}

	public function test_create_orderby_extract_array()
	{
		$orderBy = new OrderBy();
		$orderBy->extractInArray(['id' => 'DESC']);

		$this->assertEquals('DESC', $orderBy->getValue());
		$this->assertEquals('id', $orderBy->getName());
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_create_basic_orderby_invalid_value()
	{
		$orderBy = new OrderBy('id', '2121');
		$orderBy = new OrderBy('name', 'fDSA');
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_create_orderby_extract_array_invalid_value()
	{
		$orderBy = new OrderBy();
		$orderBy->extractInArray(['id' => 'FDSAFDS']);
	}
}
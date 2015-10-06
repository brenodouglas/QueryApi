<?php 
namespace QueryApi\Parse\Validator;

use PHPUnit_Framework_TestCase as PHPUnit;
use QueryApi\Parse\Validator\OrderByValidator;


class OrderByValidatorTest extends PHPUnit
{
	private $validator;

	protected function setUp()
    {   
        $this->validator = new OrderByValidator();
        parent::setUp();
    }
		
	public function test_valid_operator()
	{
		$this->assertTrue($this->validator->validValue('DESC'), 'value valid');
		$this->assertTrue($this->validator->validValue('ASC'), 'value valid');
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_invalid_operator()
	{
		$this->validator->validValue('fdas');
	}

}
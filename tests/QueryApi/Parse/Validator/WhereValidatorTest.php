<?php 
namespace QueryApi\Parse\Validator;

use PHPUnit_Framework_TestCase as PHPUnit;
use QueryApi\Parse\Validator\WhereValidator;

/**
* 
*/
class WhereValidatorTest extends PHPUnit
{
	private $validator;

	protected function setUp()
    {   
        $this->validator = new WhereValidator();
        parent::setUp();
    }
		
	public function test_valid_operator()
	{
		$this->assertTrue($this->validator->validOperator('lt'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('eq'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('neq'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('lte'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('get'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('gt'), 'operator valid');
		$this->assertTrue($this->validator->validOperator('like'), 'operator valid');
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_invalid_operator()
	{
		$this->validator->validOperator('fdas');
	}

	public function test_valid_operator_especial() 
	{
		$this->assertTrue($this->validator->validOperator('isNull'), 'especial operator is valid');
		$this->assertTrue($this->validator->validOperator('isNotNull'), 'especial operator is valid');
		$this->assertTrue($this->validator->validOperator('between'), 'especial operator is valid');
		$this->assertTrue($this->validator->validOperator('in'), 'especial operator is valid');
	}

	public function test_valid_operator_and_value()
	{
		$this->assertTrue($this->validator->validOperator('lt'), 'operator is valid');
		$this->assertTrue($this->validator->validValue('=', 'valor'), 'value and operator value is valid');
	}

	/**
     * @expectedException \InvalidArgumentException
     */
	public function test_invalid_value() 
	{
		$this->validator->validValue('=', [12, 123]);
	}

}
<?php
namespace QueryApi\Parse\Interfaces\Parameter;

/**
 * Collection parameter interface
 */
interface CollectionParameterInterface extends ParameterInterface
{

	/**
	 * Construct clausule for SQL
	 * @param String $name     Fiel database name
	 * @param String $operator operator in clausule
	 * @param String $value    value for comparator in clausule
	 */
	public function __construct($name = null, $operator = null, $value = null);

	/**
	 * extractInArray extract clauses in array
	 * @param  array  $where  pattern to the array: ['fieldName' => ['operator' => 'value']] 
	 * @return void
	 */
	public function extractInArray(array $array);

	/**
	 * getName get value
	 * @return string]
	 */
	public function getValue();

	/**
	 * getName get operator where
	 * @return string
	 */
	public function getOperator();

	/**
	 * setValue set value 
	 * @return string]
	 */
	public function setValue($value);

	/**
	 * setOperator set operator where
	 * @return string
	 */
	public function setOperator($operator);

	/**
	 * Get value of operator
	 * @return String
	 */
	public function getOperatorValue();

}
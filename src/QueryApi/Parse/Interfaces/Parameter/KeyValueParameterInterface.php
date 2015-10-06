<?php
namespace QueryApi\Parse\Interfaces\Parameter;

/**
 * Key/Value parameter interface
 */
interface KeyValueParameterInterface extends ParameterInterface
{

	/**
	 * Construct clausule for SQL
	 * @param String $name     Fiel database name
	 * @param String $operator operator in clausule
	 * @param String $value    value for comparator in clause
	 */
	public function __construct($name = null, $value = null);

	/**
	 * extractInArray extract clauses in array
	 * @param  array  $where  pattern to the array: ['id' => 'DESC']] 
	 * @return void
	 */
	public function extractInArray(array $array);
	
	/**
	 * getName get value
	 * @return string]
	 */
	public function getValue();

	/**
	 * setValue set value 
	 * @return string]
	 */
	public function setValue($value);

	/**
	 * getName get name field
	 * @return string
	 */
	public function getName();

	/**
	 * set name value
	 * @param string $name name of column in clausule
	 */
	public function setName($name);
	
}
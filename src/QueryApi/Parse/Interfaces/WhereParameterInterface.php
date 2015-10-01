<?php
namespace QueryApi\Parse\Interfaces;

/**
 * Where parameter interface
 */
interface WhereParameterInterface 
{

	/**
	 * Construct where clausule for SQL
	 * @param [type] $name     [Fiel database name]
	 * @param [type] $operator [operator in where clausule]
	 * @param [type] $value    [value for comparator in where clausule]
	 */
	public function __construct($name = null, $operator = null, $value = null);

	/**
	 * [extractInArray extract clauses for where in array]
	 * @param  array  $where [ pattern to the array: ['fieldName' => ['operator' => 'value']] ]
	 * @return void
	 */
	public function extractInArray(array $where);

	/**
	 * [getName get name field]
	 * @return [string] 
	 */
	public function getName();

	/**
	 * [getName get value]
	 * @return [string] 
	 */
	public function getValue();

	/**
	 * [getName get operator where]
	 * @return [string] 
	 */
	public function getOperator();

}
<?php 
namespace QueryApi\Parse\Interfaces\Parameter;

interface UniqueParameterInterface extends ParameterInterface
{
	/**
	 * Construct OrdeBy or Where clausule for SQL
	 * @param String $name     Fiel database name
	 * @param String $operator operator in OrdeBy or Where clausule
	 * @param String $value    value for comparator in OrdeBy or Where clausule
	 */
	public function __construct($name = null);
	
}
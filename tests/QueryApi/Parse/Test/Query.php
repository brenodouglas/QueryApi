<?php
namespace QueryApi\Parse\Test;


class Query 
{
	private $query;

	private $parameters;

	public function __construct()
	{
		$this->parameters = [];
	}

	public function where($name, $operator, $value)
	{
		$this->parameters[$name] = $value;
		$this->query = "WHERE $name $operator :$name ";
	}

	public function whereIsNull($name, $operator)
	{
		$this->parameters[$name] = $value;
		$this->query = "WHERE $name $operator ";
	}

	public function andWhere($name, $operator, $value)
	{
		$this->parameters[$name] = $value;
		$this->query .= "AND $name $operator :$name ";
	}

	public function andWhereIsNull($name, $operator)
	{
		$this->parameters[$name] = true;
		$this->query .= "AND $name $operator ";
	}

	public function getQuery()
	{
		return $this->query;
	}

	public function getParameters()
	{
		return $this->parameters;
	}
}
<?php
namespace repocount\domain;

class Employee
{
	private $employeeId;
	private $username;
	private $repositories;

	public function __construct($employeeId, $username, $repositories)
	{
		$this->employeeId = $employeeId;
		$this->username = $username;
		$this->repositories = $repositories;
	}

	public static function builder()
	{
		return new EmployeeBuilder();
	}

	public function employeeId()
	{
		return $this->employeeId;
	}

	public function username()
	{
		return $this->username;
	}

	/**
	 * @return string[]
	 */
	public function repositories()
	{
		return $this->repositories;
	}
}

class EmployeeBuilder
{
	private $employeeId;
	private $username;
	private $repositories;

	/**
	 * EmployeeBuilder constructor.
	 */
	public function __construct()
	{
		$this->repositories = array();
	}

	public function withId($employeeId)
	{
		$this->employeeId = $employeeId;
		return $this;
	}

	public function withUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	public function withRepository($repository)
	{
		array_push($this->repositories, $repository);
		return $this;
	}

	public function build()
	{
		return new Employee($this->employeeId, $this->username, $this->repositories);
	}
}

?>
<?php

use repocount\actions\UpdateEmployeeRepositories;
use repocount\domain\Employee;

class UpdateEmployeeRepositoriesTest extends PHPUnit_Framework_TestCase
{
	protected $action;
	protected $mockEmployeeQuery;
	protected $mockRepositoriesSyncService;


	protected function setUp()
	{
		parent::setUp();
		$this->mockEmployeeQuery = $this
			->getMockForAbstractClass('repocount\application\query\EmployeeQueryService');

		$this->mockRepositoriesSyncService = $this
			->getMockForAbstractClass('repocount\domain\RepositoriesSyncService');


		$this->action = new UpdateEmployeeRepositories($this->mockEmployeeQuery, $this->mockRepositoriesSyncService);
	}

	function test_updateEmployeeRepositories_should_update_employees_repository()
	{
		$nterray = Employee::builder()
			->withUsername("nterray")
			->build();
		$sandrae = Employee::builder()
			->withUsername("sandrae")
			->build();

		$employees = array($nterray, $sandrae);

		$this->mockEmployeeQuery->expects($this->once())
			->method('allEmployeesOfCompany')
			->with($this->equalTo('Enalean'))
			->willReturn($employees);

		$this->mockRepositoriesSyncService->expects($this->at(0))
			->method('sync')
			->with($this->equalTo($nterray));
		$this->mockRepositoriesSyncService->expects($this->at(1))
			->method('sync')
			->with($this->equalTo($sandrae));

		$this->action->updateEmployeeRepositories('Enalean');
	}
}

?>
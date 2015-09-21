<?php

use repocount\actions\CountCompanyEmployeesRepositories;

class CountCompanyEmployeesRepositoriesTest extends PHPUnit_Framework_TestCase
{
	protected $action;
	protected $mockEmployeeQuery;

	protected function setUp()
	{
		parent::setUp();
		$this->mockEmployeeQuery = $this
			->getMockForAbstractClass('repocount\application\query\EmployeeQueryService');
		$this->action = new CountCompanyEmployeesRepositories($this->mockEmployeeQuery);
	}

	function test_countCompanyEmployeesRepositories_should_return_0_when_company_with_no_employee()
	{
		$this->mockEmployeeQuery->expects($this->once())
			->method('countEmployeesRepositoryOfCompany')
			->with($this->equalTo('Enalean'))
			->willReturn(0);

		$count = $this->action->countCompanyEmployeesRepositories('Enalean');
		expect($count)->to->equal(0);
	}

	function test_countCompanyEmployeesRepositories_should_return_sum_of_employees_repositories()
	{
		$this->mockEmployeeQuery->expects($this->once())
			->method('countEmployeesRepositoryOfCompany')
			->with($this->equalTo('Enalean'))
			->willReturn(22);

		$count = $this->action->countCompanyEmployeesRepositories('Enalean');
		expect($count)->to->equal(22);
	}
}

?>
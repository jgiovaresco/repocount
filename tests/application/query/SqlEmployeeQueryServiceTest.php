<?php

use repocount\application\query\SqlEmployeeQueryService;

class SqlCompanyQueryServiceTest extends AbstractDatabaseTest
{
	/**
	 * @var  SqlEmployeeQueryService
	 */
	private $employeeQueryService;

	protected function setUp()
	{
		parent::setUp();
		$this->employeeQueryService = new SqlEmployeeQueryService(parent::getPdo());
	}

	/**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__) . '/count_company_employees_repo.xml');
	}

	public function test_countEmployeesRepositoryOfCompany_should_return_sum_of_repositories_of_each_employees()
	{
		$count = $this->employeeQueryService->countEmployeesRepositoryOfCompany('Enalean');
		expect($count)->to->be->equal(3);
	}

	public function test_countEmployeesRepositoryOfCompany_should_return_0_when_company_does_not_exist()
	{
		$count = $this->employeeQueryService->countEmployeesRepositoryOfCompany('unknown');
		expect($count)->to->be->equal(0);
	}
}

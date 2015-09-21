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
		return $this->createFlatXMLDataSet(dirname(__FILE__) . '/company_employees_repo.xml');
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

	public function test_allEmployeesOfCompany_should_return_employees()
	{
		$employees = $this->employeeQueryService->allEmployeesOfCompany('Enalean');
		expect($employees)->to->be->an('array')->and->to->have->length(2);
		expect($employees[0]->employeeId())->to->be->equal('abcd-efgh-ijk');
		expect($employees[0]->username())->to->be->equal('nterray');
		expect($employees[1]->employeeId())->to->be->equal('lmop-qrst-uvw');
		expect($employees[1]->username())->to->be->equal('sandrae');
	}
}

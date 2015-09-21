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

	protected function initDatabase()
	{
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `company` (
					`id` VARCHAR(36),
					`name` VARCHAR(100),
					UNIQUE (`name`),
					PRIMARY KEY (`id`)
				);");
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `employee` (
					`id` VARCHAR(36),
					`username` VARCHAR(100),
					`company_id` VARCHAR(36),
					UNIQUE (`username`),
					CONSTRAINT `fk_employee_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
					PRIMARY KEY (`id`)
				);");
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `repository` (
					`id` VARCHAR(36),
					`name` VARCHAR(100),
					`owner_id` VARCHAR(36),
					UNIQUE (`name`, `owner_id`) ON CONFLICT REPLACE,
					CONSTRAINT `fk_repository_employee` FOREIGN KEY (`owner_id`) REFERENCES `employee` (`id`),
					PRIMARY KEY (`id`)
				);");
	}

	/**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__) . '/employees.xml');
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

?>

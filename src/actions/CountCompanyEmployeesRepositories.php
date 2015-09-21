<?php

namespace repocount\actions;

use repocount\application\query\EmployeeQueryService;

class CountCompanyEmployeesRepositories
{
	/** @var EmployeeQueryService EmployeeQueryService */
	private $employeeQueryService;

	/**
	 * @param $employeeQueryService EmployeeQueryService
	 */
	public function __construct($employeeQueryService)
	{
		$this->employeeQueryService = $employeeQueryService;
	}

	/**
	 * @param $companyName string
	 * @return int
	 */
	public function countCompanyEmployeesRepositories($companyName)
	{
		return $this->employeeQueryService->countEmployeesRepositoryOfCompany($companyName);
	}
}

?>
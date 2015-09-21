<?php

namespace repocount\actions;

use repocount\application\query\EmployeeQueryService;
use repocount\domain\RepositoriesSyncService;

class UpdateEmployeeRepositories
{
	/** @var EmployeeQueryService EmployeeQueryService */
	private $employeeQueryService;
	/** @var RepositoriesSyncService RepositoriesSyncService */
	private $repositoriesSyncService;

	/**
	 * @param $employeeQueryService EmployeeQueryService
	 * @param $repositoriesSyncService RepositoriesSyncService
	 */
	public function __construct($employeeQueryService, $repositoriesSyncService)
	{
		$this->employeeQueryService = $employeeQueryService;
		$this->repositoriesSyncService = $repositoriesSyncService;
	}

	/**
	 * @param $companyName string
	 */
	public function updateEmployeeRepositories($companyName)
	{
		$employees = $this->employeeQueryService->allEmployeesOfCompany($companyName);
		foreach ($employees as $employee)
		{
			$this->repositoriesSyncService->sync($employee);
		}
	}
}

?>
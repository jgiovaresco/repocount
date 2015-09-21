<?php
namespace repocount\application\query;

use repocount\domain\Employee;

interface EmployeeQueryService
{
	/**
	 * @param $companyName
	 * @return int
	 */
	public function countEmployeesRepositoryOfCompany($companyName);

	/**
	 * @param $companyName
	 * @return Employee[]
	 */
	public function allEmployeesOfCompany($companyName);
}

?>
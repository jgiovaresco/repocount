<?php
namespace repocount\application\query;

interface EmployeeQueryService
{
	/**
	 * @param $companyName
	 * @return int
	 */
	public function countEmployeesRepositoryOfCompany($companyName);
}

?>
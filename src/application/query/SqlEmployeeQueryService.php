<?php
namespace repocount\application\query;

use repocount\domain\Employee;

class SqlEmployeeQueryService implements EmployeeQueryService
{
	private static $QUERY_COUNT_COMPANY_EMPLOYEES_REPO = "
		SELECT COUNT(r.id) as repoNum
		FROM company c, employee e, repository r
		WHERE c.id = e.company_id
  			AND e.id = r.owner_id
  			AND c.name = :companyName;
		";
	private static $QUERY_FIND_EMPLOYEES_OF_COMPANY = "
		SELECT E.id AS employee_id, E.username AS employee_username, E.company_id as company_id
		FROM COMPANY C, EMPLOYEE E
		WHERE C.NAME=:name AND C.id == E.company_id
		";

	private $pdo;
	private $countCompanyEmployeesRepoStatement;
	private $findEmployeesOfCompanyStatement;


	/**
	 * SqlEmployeeQueryService constructor.
	 * @param $pdo \PDO
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->countCompanyEmployeesRepoStatement = $pdo->prepare($this::$QUERY_COUNT_COMPANY_EMPLOYEES_REPO);
		$this->findEmployeesOfCompanyStatement = $pdo->prepare($this::$QUERY_FIND_EMPLOYEES_OF_COMPANY);
	}

	/**
	 * @param $companyName
	 * @return int
	 */
	public function countEmployeesRepositoryOfCompany($companyName)
	{
		$company = null;
		$this->countCompanyEmployeesRepoStatement->execute(array(":companyName" => $companyName));
		return intval($this->countCompanyEmployeesRepoStatement->fetchColumn());
	}

	/**
	 * @param $companyName
	 * @return Employee[]
	 */
	public function allEmployeesOfCompany($companyName)
	{
		$employees = array();
		$this->findEmployeesOfCompanyStatement->execute(array(":name" => $companyName));
		foreach ($this->findEmployeesOfCompanyStatement->fetchAll() as $row)
		{
			array_push($employees,
				Employee::builder()
					->withId($row["employee_id"])
					->withUsername($row["employee_username"])
					->build()
			);
		}
		return $employees;
	}
}

?>
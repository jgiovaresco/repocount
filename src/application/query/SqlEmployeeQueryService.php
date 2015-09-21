<?php
namespace repocount\application\query;

class SqlEmployeeQueryService implements EmployeeQueryService
{
	private static $QUERY_COUNT_COMPANY_EMPLOYEES_REPO = "
		SELECT COUNT(r.id) as repoNum
		FROM company c, employee e, repository r
		WHERE c.id = e.company_id
  			AND e.id = r.owner_id
  			AND c.name = :companyName;
		";

	private $pdo;
	private $countCompanyEmployeesRepoStatement;

	/**
	 * SqlEmployeeQueryService constructor.
	 * @param $pdo \PDO
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->countCompanyEmployeesRepoStatement = $pdo->prepare($this::$QUERY_COUNT_COMPANY_EMPLOYEES_REPO);
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
}

?>
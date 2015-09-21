<?php
namespace repocount\application\query;

class SqlTeamMemberQueryService implements TeamMemberQueryService
{
	private static $QUERY_COUNT_TEAM_MEMBERS_REPO = "
		SELECT COUNT(r.id) as repoNum
		FROM company c, team t, employee e, repository r
		WHERE c.id = t.company_id
			AND t.id = e.team_id
  			AND e.id = r.owner_id
  			AND c.name = :companyName
  			AND t.name = :teamName;
		";

	private $pdo;
	private $countTeamMemberRepoStatement;

	/**
	 * SqlTeamMemberQueryService constructor.
	 * @param $pdo \PDO
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->countTeamMemberRepoStatement = $pdo->prepare($this::$QUERY_COUNT_TEAM_MEMBERS_REPO);
	}

	/**
	 * @param $companyName
	 * @param $teamName
	 * @return int
	 */
	public function countMembersRepositoriesOfTeam($companyName, $teamName)
	{
		$this->countTeamMemberRepoStatement->execute(array(":companyName" => $companyName, ":teamName" => $teamName));
		return intval($this->countTeamMemberRepoStatement->fetchColumn());
	}
}

?>
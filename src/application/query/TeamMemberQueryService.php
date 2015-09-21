<?php
namespace repocount\application\query;

interface TeamMemberQueryService
{
	/**
	 * @param $companyName
	 * @param $teamName
	 * @return int
	 */
	public function countMembersRepositoriesOfTeam($companyName, $teamName);
}

?>
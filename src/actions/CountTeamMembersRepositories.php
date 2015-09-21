<?php

namespace repocount\actions;

use repocount\application\query\TeamMemberQueryService;

class CountTeamMembersRepositories
{
	/** @var TeamMemberQueryService TeamMemberQueryService */
	private $teamMemberQueryService;

	/**
	 * @param $teamMemberQueryService TeamMemberQueryService
	 */
	public function __construct($teamMemberQueryService)
	{
		$this->teamMemberQueryService = $teamMemberQueryService;
	}

	/**
	 * @param $companyName string
	 * @param $teamName string
	 * @return int
	 */
	public function countTeamMembersRepositories($companyName, $teamName)
	{
		return $this->teamMemberQueryService->countMembersRepositoriesOfTeam($companyName, $teamName);
	}
}

?>
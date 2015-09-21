<?php

use repocount\application\query\SqlTeamMemberQueryService;

class SqlTeamMemberQueryServiceTest extends AbstractDatabaseTest
{
	/**
	 * @var  SqlTeamMemberQueryService
	 */
	private $teamMemberQueryService;

	protected function setUp()
	{
		parent::setUp();
		$this->teamMemberQueryService = new SqlTeamMemberQueryService(parent::getPdo());
	}

	/**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__) . '/count_team_members_repo.xml');
	}

	public function test_countMembersRepositoriesOfTeam_should_return_sum_of_repositories_of_each_team_member()
	{
		$count = $this->teamMemberQueryService->countMembersRepositoriesOfTeam('Enalean', 'TeamA');
		expect($count)->to->be->equal(3);
	}

	public function test_countMembersRepositoriesOfTeam_should_return_0_when_company_does_not_exist()
	{
		$count = $this->teamMemberQueryService->countMembersRepositoriesOfTeam('unknown', 'TeamA');
		expect($count)->to->be->equal(0);
	}

	public function test_countMembersRepositoriesOfTeam_should_return_0_when_team_does_not_exist()
	{
		$count = $this->teamMemberQueryService->countMembersRepositoriesOfTeam('Enalean', 'unknown');
		expect($count)->to->be->equal(0);
	}
}

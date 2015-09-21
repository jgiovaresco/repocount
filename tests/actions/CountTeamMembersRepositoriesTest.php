<?php

use repocount\actions\CountTeamMembersRepositories;

class CountTeamMembersRepositoriesTest extends PHPUnit_Framework_TestCase
{
	protected $action;
	protected $mockEmployeeQuery;

	protected function setUp()
	{
		parent::setUp();
		$this->mockEmployeeQuery = $this
			->getMockBuilder('repocount\application\query\TeamMemberQueryService')
			->disableOriginalConstructor()
			->setMethods(array('countMembersRepositoriesOfTeam'))
			->getMock();
		$this->action = new CountTeamMembersRepositories($this->mockEmployeeQuery);
	}

	function test_countTeamMembersRepositories_should_return_0_when_team_with_no_member()
	{
		$this->mockEmployeeQuery->expects($this->once())
			->method('countMembersRepositoriesOfTeam')
			->with($this->equalTo('Enalean'), $this->equalTo("TeamA"))
			->willReturn(0);

		$count = $this->action->countTeamMembersRepositories('Enalean', 'TeamA');
		expect($count)->to->equal(0);
	}

	function test_countCompanyEmployeesRepositories_should_return_sum_of_employees_repositories()
	{
		$this->mockEmployeeQuery->expects($this->once())
			->method('countMembersRepositoriesOfTeam')
			->with($this->equalTo('Enalean'), $this->equalTo("TeamA"))
			->willReturn(17);

		$count = $this->action->countTeamMembersRepositories('Enalean', 'TeamA');
		expect($count)->to->equal(17);
	}
}
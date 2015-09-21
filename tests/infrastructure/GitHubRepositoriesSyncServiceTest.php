<?php

use repocount\domain\Employee;
use repocount\domain\Repository;
use repocount\infrastructure\GitHubRepositoriesSyncService;

class GitHubRepositoriesSyncServiceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  GitHubRepositoriesSyncService
	 */
	private $syncService;
	private $mockGitHubRestClient;
	private $mockRepositoryRepository;

	protected function setUp()
	{
		parent::setUp();
		$this->mockGitHubRestClient = $this
			->getMockBuilder('repocount\infrastructure\GitHubRestClient')
			->disableOriginalConstructor()
			->setMethods(array('listUserRepositories'))
			->getMock();

		$this->mockRepositoryRepository = $this
			->getMockBuilder('repocount\domain\RepositoryRepository')
			->disableOriginalConstructor()
			->setMethods(array('save'))
			->getMock();

		$this->syncService = new GitHubRepositoriesSyncService($this->mockGitHubRestClient, $this->mockRepositoryRepository);
	}

	public function test_sync_should_get_repositories_from_github_and_save_them() {
		$employee = Employee::builder()->withUsername("jgiovaresco")->build();
		$repositories = array(
			Repository::builder()->withName("repo1")->build(),
			Repository::builder()->withName("repo2")->build()
		);

		$this->mockGitHubRestClient->expects($this->once())
			->method('listUserRepositories')
			->with('jgiovaresco')
			->willReturn($repositories);

		$this->mockRepositoryRepository->expects($this->at(0))
			->method('save')
			->with($this->equalTo($repositories[0]));
		$this->mockRepositoryRepository->expects($this->at(1))
			->method('save')
			->with($this->equalTo($repositories[1]));

		$this->syncService->sync($employee);
	}
}

?>
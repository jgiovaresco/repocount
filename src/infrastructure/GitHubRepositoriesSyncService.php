<?php
namespace repocount\infrastructure;

use repocount\domain\Employee;
use repocount\domain\RepositoriesSyncService;
use repocount\domain\RepositoryRepository;

class GitHubRepositoriesSyncService implements RepositoriesSyncService
{
	/**
	 * @var GitHubRestClient
	 */
	private $githubRestClient;
	/**
	 * @var RepositoryRepository
	 */
	private $repositoryRepository;

	/**
	 * @param GitHubRestClient $gitHubRestClient
	 * @param RepositoryRepository $repositoryRepository
	 */
	public function __construct(GitHubRestClient $gitHubRestClient, RepositoryRepository $repositoryRepository)
	{
		$this->githubRestClient = $gitHubRestClient;
		$this->repositoryRepository = $repositoryRepository;
	}

	/**
	 * @param $employee Employee
	 */
	public function sync($employee)
	{
		$repositories = $this->githubRestClient->listUserRepositories($employee->username());
		foreach ($repositories as $repository)
		{
			$this->repositoryRepository->save($repository);
		}
	}
}

?>
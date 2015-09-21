<?php
namespace repocount\infrastructure;

use Httpful\Request;
use repocount\domain\Employee;
use repocount\domain\Repository;

class GitHubRestClient
{
	const BASE_URL = "https://api.github.com/users";

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * GitHubRestClient constructor.
	 * @param $request Request
	 */
	public function __construct($request = null)
	{
		if (null != $request)
		{
			$this->request = $request;
		}
		else
		{
			$this->request = Request::init();
		}
	}


	/**
	 * @param $employee Employee
	 * @return Repository[]
	 */
	public function listUserRepositories($employee)
	{
		$url = self::BASE_URL . '/' . $employee->username() . '/repos';
		$response = $this->request
			->uri($url)
			->expectsJson()
			->send();

		$repositories = array();
		if (is_array($response->body))
		{
			foreach ($response->body as $repo)
			{
				array_push(
					$repositories,
					Repository::builder()
						->withId($repo->id)
						->withName($repo->name)
						->withOwnerId($employee->employeeId())
						->build()
				);
			}
		}
		return $repositories;
	}
}

?>
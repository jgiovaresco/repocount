<?php

use repocount\domain\Repository;
use repocount\infrastructure\RepositorySqlRepository;

class RepositorySqlRepositoryTest extends AbstractDatabaseTest
{
	/**
	 * @var RepositorySqlRepository
	 */
	private $repository;

	protected function setUp()
	{
		parent::setUp();
		$this->repository = new RepositorySqlRepository(parent::getPdo());
	}

	/**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		return $this->createFlatXMLDataSet(dirname(__FILE__) . '/no_repositories.xml');
	}

	public function test_save_should_insert_repositories_in_database()
	{
		$this->repository->save(Repository::builder()->withId('123')->withName('new_repo')->withOwnerId('abcd-efgh-ijk')->build());

		expect($this->getConnection()->getRowCount('repository'))->to->equal(1);
		$queryTable = $this->getConnection()->createQueryTable('repository', 'SELECT * FROM repository');
		expect($queryTable->getRow(0))
			->to->equal(array(
				"id" => "123",
				"name" => "new_repo",
				"owner_id" => "abcd-efgh-ijk"
			));
	}

}

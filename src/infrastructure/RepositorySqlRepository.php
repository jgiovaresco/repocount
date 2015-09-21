<?php
namespace repocount\infrastructure;

use repocount\domain\Repository;
use repocount\domain\RepositoryRepository;

class RepositorySqlRepository implements RepositoryRepository
{
	private static $SAVE_REPOSITORY = "INSERT INTO repository (id, name, owner_id) VALUES(:id, :name, :ownerId)";

	private $pdo;
	private $saveStatement;


	/**
	 * SqlEmployeeQueryService constructor.
	 * @param $pdo \PDO
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
		$this->saveStatement = $pdo->prepare($this::$SAVE_REPOSITORY);
	}

	/**
	 * @param $repository Repository
	 * @return int
	 */
	public function save($repository)
	{
		$this->saveStatement->execute(array(
			":id" => $repository->id(),
			":name" => $repository->name(),
			":ownerId" => $repository->ownerId()
		));
	}
}

?>
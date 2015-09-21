<?php
namespace repocount\domain;

interface RepositoryRepository
{
	/**
	 * @param $repo Repository
	 */
	public function save($repo);
}

?>
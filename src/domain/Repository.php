<?php
namespace repocount\domain;

class Repository
{
	private $id;
	private $ownerId;
	private $name;

	public function __construct($id, $ownerId, $name)
	{
		$this->id = $id;
		$this->ownerId = $ownerId;
		$this->name = $name;
	}

	public static function builder()
	{
		return new RepositoryBuilder();
	}

	public function id()
	{
		return $this->id;
	}

	public function ownerId()
	{
		return $this->ownerId;
	}

	public function name()
	{
		return $this->name;
	}
}

class RepositoryBuilder
{
	private $id;
	private $ownerId;
	private $name;

	public function withId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function withOwnerId($ownerId)
	{
		$this->ownerId = $ownerId;
		return $this;
	}

	public function withName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function build()
	{
		return new Repository($this->id, $this->ownerId, $this->name);
	}
}

?>
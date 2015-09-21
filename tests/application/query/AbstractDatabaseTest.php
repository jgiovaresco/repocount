<?php

abstract class AbstractDatabaseTest extends PHPUnit_Extensions_Database_TestCase
{
	/**
	 * @var \PDO
	 */
	static private $pdo = null;

	/**
	 * @var \PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	private $connection = null;

	protected function getTearDownOperation()
	{
		return \PHPUnit_Extensions_Database_Operation_Factory::TRUNCATE();
	}

	/**
	 * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	protected function getConnection()
	{
		if (null === $this->connection)
		{
			if (null == self::$pdo)
			{
				self::$pdo = new \PDO('sqlite::memory:');
			}

			$this->connection = $this->createDefaultDBConnection(self::$pdo, ":memory:");
			$this->createSchema();
		}

		return $this->connection;
	}

	protected function getPdo()
	{
		return self::$pdo;
	}

	/**
	 * Create schema in sqlite database
	 */
	protected function createSchema()
	{
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `company` (
					`id` VARCHAR(36),
					`name` VARCHAR(100),
					UNIQUE (`name`),
					PRIMARY KEY (`id`)
				);");
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `team` (
					`id` VARCHAR(36),
					`name` VARCHAR(100),
					`company_id` VARCHAR(36),
					UNIQUE (`name`),
					CONSTRAINT `fk_team_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
					PRIMARY KEY (`id`)
				);");
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `employee` (
					`id` VARCHAR(36),
					`username` VARCHAR(100),
					`company_id` VARCHAR(36),
					`team_id` VARCHAR(36),
					UNIQUE (`username`),
					CONSTRAINT `fk_employee_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
					CONSTRAINT `fk_employee_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
					PRIMARY KEY (`id`)
				);");
		$this->getPdo()
			->query("CREATE TABLE IF NOT EXISTS `repository` (
					`id` VARCHAR(36),
					`name` VARCHAR(100),
					`owner_id` VARCHAR(36),
					UNIQUE (`name`, `owner_id`) ON CONFLICT REPLACE,
					CONSTRAINT `fk_repository_employee` FOREIGN KEY (`owner_id`) REFERENCES `employee` (`id`),
					PRIMARY KEY (`id`)
				);");
	}
}
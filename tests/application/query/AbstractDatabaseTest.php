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
			$this->initDatabase();
		}

		return $this->connection;
	}

	protected function getPdo()
	{
		return self::$pdo;
	}

	protected abstract function initDatabase();

}

?>
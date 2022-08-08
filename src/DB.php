<?php

namespace App;

class DB
{
	private static $instance;
	private \PDO $pdo;

	private function __construct()
	{
		$this->pdo = new \PDO(
			'mysql:host='. Config::getInst()->getHost() . ';dbname=' . Config::getInst()->getDbName(),
			Config::getInst()->getUser(),
			Config::getInst()->getPassword(),
			 [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION ]
		);
	}

	public function getPDO(): \PDO
	{
		return $this->pdo;
	}

	public static function getInst(): self
	{
		if (self::$instance instanceof self) {
			return self::$instance;
		}

		return self::$instance = new DB();
	}

	public function executeSelect(string $sql, array $values)
	{
		$stm = $this->pdo->prepare($sql);

		foreach ($values as $key => $value) {
			$stm->bindValue($key, $value);
		}

		if (!$stm->execute()) {
			throw new \Exception($stm->errorInfo());
		}

		return $stm->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function insert(string $sql, array $values): bool
	{
		$statement = $this->pdo->prepare($sql);

		if (!$statement->execute($values)) {
			throw new \Exception('Can\'t proceed insert!' . $sql);
		}

		return true;
	}
}
<?php

namespace App\Models;

use App\DB;


abstract class BaseModel
{
	abstract public function getTable(): string;

	public function findAll(): array
	{
		$sql = 'SELECT * FROM '. $this->getTable(). ' ';

		return DB::getInst()->executeSelect($sql, []);
	}

	public function findAllBy(array $conditions): array
	{
		$sql = 'SELECT * FROM '. $this->getTable(). ' WHERE ';
		$where = [];
		foreach ($conditions as $field => $value) {
			$values[':' . $field] = $value;
			$where[] = $field . ' = :' . $field;
		}

		$sql .= implode(' AND ', $where);

		return DB::getInst()->executeSelect($sql, $values);
	}

	/**
	 * @param array $conditions
	 * @return false|mixed
	 * @throws \Exception
	 */
	public function findOneBy(array $conditions)
	{
		$sql = 'SELECT * FROM '. $this->getTable(). ' WHERE ';
		$where = [];

		foreach ($conditions as $field => $value) {
			$where[] = $field . ' = :' . $field;
		}

		$sql .= implode(' AND ', $where) . ' LIMIT 1';

		return current(DB::getInst()->executeSelect($sql, $conditions));
	}

	/**
	 * @param array $data
	 * @return false|mixed
	 * @throws \Exception
	 */
	public function insert(array $data): bool
	{
		$sql = 'INSERT INTO '. $this->getTable(). ' ';

		$columns = array_keys($data);
		$columnsPrepared = array_map(static fn($item) => ':' . $item, $columns);
		$columns = implode(',', $columns);
		$values = implode(',', $columnsPrepared);

		$sql = 'INSERT INTO '. $this->getTable(). ' (' . $columns . ') VALUES ('. $values . ')';

		return DB::getInst()->insert($sql, $data);
	}
}
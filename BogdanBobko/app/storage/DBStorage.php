<?php

namespace CSR\App\Storage;

use CSR\App\DBGW\DBGW;

class DBStorage {
	const DEFAULT_DB = 'array_storage';

	private $connection;

	public function __construct() {
		$DBGW = new DBGW();

		$this->connection = $DBGW->getConnection();
		$this->connection->select_db(self::DEFAULT_DB);
	}

	public function saveArray($type, $title, $array)
	{
		$statement = $this->connection->prepare('INSERT INTO `array` (`type`, `title`, `data`) VALUES (?, ?, ?)');
		$statement->bind_param('sss', $type, $title, serialize($array));
		$statement->execute();
		$statement->close();
	}

	public function getArray($type)
	{
		$title = $data = null;
		$statement = $this->connection->prepare('
			SELECT `title`, `data`
			FROM `array`
			WHERE `type` = ?
			ORDER BY `id` DESC
			LIMIT 1
		');
		$statement->bind_param('s', $type);
		$statement->execute();
		$statement->bind_result($title, $data);
		$statement->fetch();

		return unserialize($data);
	}
}

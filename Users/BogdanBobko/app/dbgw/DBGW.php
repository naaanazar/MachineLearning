<?php

namespace CSR\App\DBGW;

use mysqli;

use CSR\App\Exceptions\MySQLConnectException;

class DBGW {
	const CRED_HOST = 'host';
	const CRED_USER = 'username';
	const CRED_PASS = 'passwd';

	private $connection = null;
	private $credentials = array(
		self::CRED_HOST => DB_HOST,
		self::CRED_USER => DB_USER,
		self::CRED_PASS => DB_PASS,
	);

	public function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		$this->connection = new mysqli(
			$this->credentials[self::CRED_HOST], 
			$this->credentials[self::CRED_USER],
			$this->credentials[self::CRED_PASS]
		);

		if ($this->connection->connect_errno) {
			throw new MySQLConnectException(
				sprintf('Connection failed: %s\n', $this->connection->connect_error)
			);
		}
	}

	public function getConnection()
	{
		if (!$this->connection) {
			$this->connect();
		}

		return $this->connection;
	}
}

<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 10.06.2017
 * Time: 11:22
 */

namespace Configuration;


class Database {

	protected $host 		= 'localhost';
	protected $port			= 3306;
	protected $user			= '';
	protected $password		= '';
	protected $dbname		= '';
	protected $driver		= '';

	/**
	 * Database constructor.
	 * @param array $array
	 * @param $loader
	 * @throws \Exception
	 */
	public function __construct(array $array = []) {
		$this->setData($array);
	}

	/**
	 * @param array $array
	 * @return Database
	 */
	public function setData(array $array): Database {
		if (!empty($array)) {
			foreach ($array AS $key => $value) {
				$methodName = 'set' . ucfirst($key);
				if (method_exists($this, $methodName)) {
					$this->$methodName($value);
				}
			}
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getHost(): string {
		return $this->host;
	}

	/**
	 * @param string $host
	 * @return Database
	 */
	public function setHost(string $host): Database {
		$this->host = $host;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPort(): int {
		return $this->port;
	}

	/**
	 * @param int $port
	 * @return Database
	 */
	public function setPort(int $port): Database {
		$this->port = $port;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUser(): string {
		return $this->user;
	}

	/**
	 * @param string $user
	 * @return Database
	 */
	public function setUser(string $user): Database {
		$this->user = $user;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return Database
	 */
	public function setPassword(string $password): Database {
		$this->password = $password;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDbname(): string {
		return $this->dbname;
	}

	/**
	 * @param string $dbname
	 * @return Database
	 */
	public function setDbname(string $dbname): Database {
		$this->dbname = $dbname;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDriver(): string {
		return $this->driver;
	}

	/**
	 * @param string $driver
	 * @return Database
	 */
	public function setDriver(string $driver): Database {
		$this->driver = $driver;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getCredentials(): array {
		return [
			'host' => $this->getHost(),
			'port' => $this->getPort(),
			'user' => $this->getUser(),
			'password' => $this->getPassword(),
			'dbname' => $this->getDbname(),
			'driver' => $this->getDriver()
		];
	}
}
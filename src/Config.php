<?php

namespace App;

class Config
{
	private static $instance;
    private array $config;

	private function __construct(array $config)
	{
		$this->config = $config;
	}

	public static function getInst(): self
	{
		if (self::$instance instanceof Config) {
			return self::$instance;
		}

		return self::$instance = new Config(include(getcwd() . '/../src/configs/config.php'));
	}

    public function getHost() : string
    {
        return $this->config['host'] ?? '';
    }

    public function getDbName() : string
    {
	    return $this->config['dbname'] ?? '';
    }

    public function getUser() : string
    {
	    return $this->config['db_username'] ?? '';
    }

    public function getPassword() : string
    {
	    return $this->config['db_password'] ?? '';
    }
}
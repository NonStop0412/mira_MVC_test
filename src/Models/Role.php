<?php

namespace App\Models;

class Role extends BaseModel
{
	public const ROLE_DIRECTOR = 1;
	public const ROLE_MANAGER = 2;
	public const ROLE_PERFORMER = 3;

	public function getTable(): string
	{
		return 'roles';
	}

	public static function getRoles()
	{
		return [
			self::ROLE_DIRECTOR => 'Director',
			self::ROLE_MANAGER => 'Manager',
			self::ROLE_PERFORMER => 'Performer'
		];
	}

    public static function getRole(int $id)
    {
        $role = self::getRoles();

        return $role[$id];
    }
}
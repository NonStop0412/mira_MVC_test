<?php

namespace App\Models;

class User extends BaseModel
{
	public function getTable(): string
	{
		return 'users';
	}

	public function getUsers() : array
    {
        return $this->findAll();
    }

    public function getUser(string $email)
    {
        $user = $this->findOneBy(['email' => $email]);

        return $user;
    }

    public function loginUser(string $email, string $password) : bool
    {
	    $user = $this->findOneBy(['email' => $email, 'password' => $password]);

		if (!empty($user)) {

			return true;
		}

        return false;
    }

    public function createUser(string $email, string $password, int $role) : void
    {
        $this->insert(['email' => $email, 'password' => $password, 'role_id' => $role]);
    }

}
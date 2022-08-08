<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class AuthController
{
    private $view;
    private $userModel;

    public function __construct($view, User $userModel)
    {
        $this->view = $view;
        $this->userModel = $userModel;
    }

    public function indexAction()
    {
        $path = 'login';
        return $this->view->render($path);
    }

    public function auth()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if ($this->userModel->loginUser($email, $password)) {
			$user = $this->userModel->getUser($email);
            $_SESSION['user'] = $user;
            $_SESSION['role'] = Role::getRole($user['role_id']);

            return header("Location: /");
        }
            print_r('Error');

            return $this->indexAction();
    }

    public function logout()
    {
        session_destroy();

        return header("Location: /");
    }
}
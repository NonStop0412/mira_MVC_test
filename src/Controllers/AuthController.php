<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use App\View;

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
        echo "I am in AuthController";

        $path = 'login';

        return $this->view->render($path);
    }

    public function auth()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if ($this->userModel->loginUser($email, $password)) {
            print_r('Authorize');
			$user = $this->userModel->getUser($email);
            $_SESSION['user'] = $user;
            $_SESSION['role'] = Role::getRole($user['role_id']);
            $path = 'index';
            return $this->view->render($path);
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
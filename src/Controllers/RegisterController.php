<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class RegisterController
{
    private $view;

    public function __construct($vue, User $userModel)
    {
        $this->view = $vue;
        $this->userModel = $userModel;
    }

    public function indexAction()
    {
		$data = [
			'roles' => Role::getRoles()
		];

        $path = 'registration';

        return $this->view->render($path, $data);
    }

    public function registration()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
	    $role = $_POST['role_id'];

        if(!empty($this->userModel->getUser($email))) {

            print_r('This User Exist!');
            $this->indexAction();
        }

        $this->userModel->createUser($email, $password, $role);

        if(!empty($this->userModel->getUser($email))){

            print_r('Registered!');
            $path = 'index';

            return $this->view->render($path);
            }
        }
}
<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class IndexController extends MainController
{
    public $errors = [];

    public function indexAction()
    {
        if (isset($_POST['logout'])) {
            unset($_SESSION);
            session_destroy();
            header('Location: /');
        }
        $errors = [];
        if (isset($_POST['submit'])) {
            unset ($_POST['submit']);
            $_POST['login'] = htmlspecialchars($_POST['login']);
            $user = new User();
            $errors = $user->loginUser($_POST);
            if (!$errors) {
                $_SESSION['login'] = $_POST['login'];
            }
            header('Location: /');
        }
        $this->view->twigLoad('auth', ['errors' => $errors, 'login' => $_POST['login']]);
    }
}

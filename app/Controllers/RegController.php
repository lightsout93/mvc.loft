<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Core\View;
use App\Models\File;
use App\Models\User;

class RegController extends MainController
{
    public $errors = [];

    public function regAction()
    {
        $view = new View();
        $data = [];
        $this->errors[0] = '';
        if ($_POST['submit'] === '') {
            unset ($_POST['submit']);
            $data = $this->validateForm($_POST);
        }
        if (empty($this->errors)) {
            $user = new User();
            $result = $user->createUser($data);
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photo = new File();
                $photo->addFile();
            }
            if ($result == false) {
                $this->errors[0] = 'Пользователь с таким логином уже существует';
            } else {
                $_SESSION['login'] = $data['login'];
                header('Location: /index');
            }
        }
        $view->twigLoad('reg', ['errors' => $this->errors, 'post' => $_POST]);
    }

    private function validateForm($data)
    {
        unset ($this->errors);
        foreach ($data as $key => $value) {
            $value = htmlspecialchars($value);
            if ($key != 'password' or $key != 'password2') {
                $value = trim($value);
            }
        }
        if (mb_strlen($data['login']) < 4) {
            $this->errors[] = 'Логин должен содержать 4 или больше символов';
        }
        if (preg_match('[a-zA-Z0-9]', $data['login'])) {
            $this->errors[] = 'Логин должен содержать только латинские буквы и цифры';
        }
        if (mb_strlen($data['password'] < 6)) {
            $this->errors[] = 'Пароль должен содержать 6 или больше символов';
        }
        if ($data['password'] != $data['password2']) {
            $this->errors[] = 'Пароли должны совпадать';
        } else {
            unset($data['password2']);
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}

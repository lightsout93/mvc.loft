<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class UserController extends MainController
{
    public function userAction()
    {
        $user = new User();
        if ($_GET['id']) {
            $login = $user->deleteUser($_GET['id']);
            $filename = '../public/upload/' . $login . '.jpg';
            if (file_exists($filename)) {
                unlink($filename);
            }
            header('Location: /user');
        }
        if ($_GET['sort'] == 'asc' or empty($_GET['sort'])) {
            $data = $user->getAllUsers('asc');
            $sort = 'desc';
        } else {
            $data = $user->getAllUsers('desc');
            $sort = 'asc';
        }
        foreach ($data as $key => $value) {
            if ($value['age'] < 18) {
                $data[$key]['age'] = $value['age'] . '- Несовершеннолетний';
            } else {
                $data[$key]['age'] = $value['age'] . '- Cовершеннолетний';
            }
        }
        $this->view->twigLoad('user', ['users' => $data, 'sort' => $sort]);
    }
}
<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class FileController extends MainController
{
    public function fileAction()
    {
        $user = new User();
        $data = $user->getAllUsers('asc');
        foreach ($data as $key => $value) {
            $login = $data[$key]['login'];
            $filename = '../public/upload/' . $login . '.jpg';
            if (!file_exists($filename)) {
                unset($data[$key]);
            }
        }
        if ($_GET['id']) {
            $login = $user->getUser($_GET['id'])['login'];
            $filename = '../public/upload/' . $login . '.jpg';
            if (file_exists($filename)) {
                unlink($filename);
            }
            header('Location: /file');
        }
        $this->view->twigLoad('file', ['files' => $data]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: shika
 * Date: 29.06.2018
 * Time: 4:34
 */
namespace App\Controllers;

use App\Core\MainController;
use App\Core\View;
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
        $view = new View();
        $view->twigLoad('file', ['files' => $data]);
    }
}

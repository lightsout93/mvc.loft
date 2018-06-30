<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as IImage;

class File
{
    // file = $_FILES['photo']['tmp_name'];
    public function addFile($file)
    {
        if (file_exists($file)) {
            IImage::make($file)->resize(150, 150)->save(PUBLIC_PATH . '/upload/' . $_POST['login'] . '.jpg');
        }
    }
}
<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as IImage;

class File
{
    public function addFile()
    {
        IImage::make($_FILES['photo']['tmp_name'])->resize(150, 150)->save(PUBLIC_PATH.'/upload/'.$_POST['login'].'.jpg');
    }
}
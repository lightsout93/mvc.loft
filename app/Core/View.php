<?php

namespace App\Core;

use Twig_Environment;

class View
{
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new \Twig_Loader_Filesystem(PUBLIC_PATH);
        $this->twig = new Twig_Environment($this->loader);
        $this->twig->addGlobal('session', $_SESSION['login']);

    }

    public function twigLoad(string $filename, array $data)
    {
        echo $this->twig->render($filename . ".html", $data);
    }
}

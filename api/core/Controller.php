<?php

trait Controller
{
    public function view($name)
    {

        $extensions = ['php', 'html'];
        $filename = null;

        foreach ($extensions as $ext) {
            $path = "../views/{$name}.{$ext}";
            if (file_exists($path)) {
                $filename = $path;
                break;
            }
        }

        if (!isset($filename)) {
            $filename = "../views/error/error_404.html";
        }

        require $filename;
    }
    public function redirect($name)
    {
        header("Location: " . ROOT . $name);
        exit;
    }
    public function back()
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

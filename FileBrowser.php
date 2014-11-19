<?php
/**
 * Created by PhpStorm.
 * User: aaly
 * Date: 15.11.14
 * Time: 16:07
 */

class FileBrowser
{
    public $current_dir = 'upload/';

    public function out()
    {
        $paths = explode("/", $this->current_dir);
        $this->current_dir = "";
        for ($i = 0; $i < sizeof($paths) - 2; $i++)
            $this->current_dir .= $paths[$i] . "/";
    }

    public function create_dir($name)
    {
        $oldmask = umask(0);
        mkdir($this->current_dir . $name, 0777);
        umask($oldmask);
    }

    public function listElements()
    {
        if ($handle = opendir($this->current_dir)) {
            while (false !== ($file = readdir($handle)))
                if ($file != "." && $file != "..")
                    if (is_dir('upload/' . $file))
                        echo "<a href=\"javascript:opendir('" . $file . "/')\"><li><i class=\"icon-large icon-folder-open\"></i>" . $file . "</li></a>";
                    else
                        echo "<a href=\"javascript:openfile('" . $this->current_dir . $file . "')\"><li><i class=\"icon-large icon-picture\"></i>" . $file . "</li></a>";
            closedir($handle);
        }

    }

    public function open_file($file)
    {
        echo '<img class="anpassen" src="' . $file . '" alt="' . $file . '">';
    }

    /**
     * @return string
     */
    public function getCurrentDir()
    {
        return $this->current_dir;
    }

    /**
     * @param string $current_dir
     */
    public function setCurrentDir($current_dir)
    {
        $this->current_dir = $current_dir;
    }
} 
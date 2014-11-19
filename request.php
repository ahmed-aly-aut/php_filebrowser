<?php
include("FileBrowser.php");
$f = new FileBrowser();
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'back') {
        $f->setCurrentDir($_REQUEST['back']);
    }
    if ($_REQUEST['action'] == 'out') {
        $f->setCurrentDir($_REQUEST['current']);
        $f->out();
    }
    if ($_REQUEST['action'] == 'forward') {
        $f->setCurrentDir($_REQUEST['forward']);
    }
    if ($_REQUEST['action'] == 'home') {
        $f->setCurrentDir($_REQUEST['current']);
    }
    if ($_REQUEST['action'] == 'createdir') {
        $f->setCurrentDir($_REQUEST['current']);
        $f->create_dir($_REQUEST['dir']);
    }
    if ($_REQUEST['action'] == 'opendir') {
        $f->setCurrentDir($_REQUEST['current'] . $_REQUEST['dir']);
    }
    if ($_REQUEST['action'] == 'openfile') {
        $f->setCurrentDir($_REQUEST['current']);
        $f->open_file($_REQUEST['file']);
    }
    if ($_REQUEST['action'] == 'listelements') {
        $f->setCurrentDir($_REQUEST['current']);
    }
    if ($_REQUEST['action'] != 'openfile')
        $f->listElements($_REQUEST['current']);
}


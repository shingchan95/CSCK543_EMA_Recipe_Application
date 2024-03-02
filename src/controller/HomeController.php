<?php
class HomeController {
    public function index() {
        $currentDirectory = __DIR__;
        $homeFilePath = $currentDirectory . '/../view/home.php';
        include $homeFilePath;
    }
}
?>
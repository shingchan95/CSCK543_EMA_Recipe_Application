<?php
class ProfileController {

    public function index($currentPage, $loggedUser) {
        include __DIR__. '/../view/profile.php';
    }
}
?>
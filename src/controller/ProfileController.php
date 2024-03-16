<?php
require_once __DIR__ . '/../model/FavouritesModel.php';


class ProfileController
{

    private $favouritesModel;
    private $userModel;

    public function __construct()
    {
        global $conn;
        $this->favouritesModel = new FavouritesModel($conn);
        $this->userModel = new UserModel($conn);
    }

    public function index($user_id)
    {
        $profileDetails = $this->userModel->getUserById($user_id);
        $favoriteRecipes = $this->favouritesModel->getFavouriteRecipes($user_id);
        $this->render('profile', ['favoriteRecipes' => $favoriteRecipes, 'profileDetails' => $profileDetails]);
    }

    public function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        include __DIR__ . "/../view/$view.php";
    }
}

?>

<?php
require_once __DIR__ . '/../model/FavouritesModel.php';


class ProfileController {

    private $favouritesModel;
    public function __construct() {
        global $conn;
        $this->favouritesModel = new FavouritesModel($conn);

    }

    public function index($user_id) {
        $recipes = $this->favouritesModel->getFavouriteRecipes($user_id);
        $this->render('profile', ['recipes' => $recipes]);
    }

    public function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        } else {
            echo "Recipe not found";
        }
        include __DIR__ . "/../view/$view.php";
    }
}
?>

<?php
require_once __DIR__ . '/../model/FavouritesModel.php';

/**
 * ProfileController class handles profile-related operations.
 */
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

     /**
     * Index method retrieves user profile details and favorite recipes.
     * Renders the profile view with the retrieved data.
     * @param int $user_id The ID of the user whose profile is being viewed.
     */
    public function index($user_id)
    {
        try {
            // Get user profile details
            $profileDetails = $this->userModel->getUserById($user_id);
            // Get favorite recipes of the user
            $favoriteRecipes = $this->favouritesModel->getFavouriteRecipes($user_id);
            // Render the profile view with retrieved data
            $this->render('profile', ['favoriteRecipes' => $favoriteRecipes, 'profileDetails' => $profileDetails]);
        } catch (Exception $e) {
            // Handle any exceptions that occur and display an error message
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Renders the specified view with the provided data.
     * @param string $view The name of the view file to render.
     * @param array $data The data to pass to the view.
     */
    public function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        include __DIR__ . "/../view/$view.php";
    }
}

?>

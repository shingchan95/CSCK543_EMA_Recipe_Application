/* The controller acts as the interface between frontend and backend.
Basically it is the controller that decides to render the View and fetches info from the Model.

Ideally, backend guys would create the model's methods for fetching data, e.g.: getUsersSortedByAge()
and pass it to the view through the Controller.
*/
<?php
include '../model/ExampleUserModel.php';
include '../view/ExampleUserView.php';

class ExampleUserController
{
    private $userModel;
    private $userView;

    public function __construct()
    {
        $this->userModel = new ExampleUserModel();
        $this->userView = new ExampleUserView();
    }

    public function sayHello($name)
    {
        $user = $this->userModel->getUserByName($name);
        $this->userView->render($user); // here we are rendering the view and passing it the user we got from the database.
    }
}

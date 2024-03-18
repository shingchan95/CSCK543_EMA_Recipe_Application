# The Yummy Chef
The Yummy Chef is a web application designed to help users discover, save, and rate recipes. It allows users to browse through a collection of recipes, save their favorite recipes, and provide ratings for recipes they have tried.

## Features
- Browse through a collection of recipes
- Save favorite recipes for quick access
- Rate recipes based on personal experience
- User-friendly interface for easy navigation
- Responsive layout for mobile user
- Sorting on search recipes
- Filter on search recipes

## Installation and Setup

### Prerequisites
- PHP (version 7 or 8 )
- MySQL database server
- Web server (e.g., Apache)

### Installation Steps
1. Configure the database settings in config/database.php file.

2. Import the database dump file database.sql located in the root folder into your MySQL database.

3. Start your web server (e.g., Apache) and MySQL database server.

4. You can use XAMPP or any other local development environment to run the application.

5. Open your web browser and visit 'http://localhost/(folder-name)' to access the The Yummy Chef.

6. Alternatively, you can navigate to the project directory in your terminal and run the following command to start the application

```
php -S 127.0.0.1:80 -t .
```

## Usage

1. Browse Recipes:
    - Browse through the featured recipes or search through a list of recipes. 
    - Each recipe card displays essential details such as the recipe name, author, and an image.

2. View Recipe Details:
    - Click on a recipe card to view its details. The recipe details page includes comprehensive information such as ingredients, preparation steps, cooking time and serving size etc.
    - Adjust the serving size dynamically to automatically calculate ingredient portions for the desired number of servings.
    
3. Save Recipes to Favorites:
    - While viewing a recipe, click the "Save Recipe to Favorites" button to add the recipe to your favorites list.
    - Access your saved recipes later from the profile page for quick reference.

4. Rate Recipes:
    - After trying a recipe, select a rating from the star options to provide feedback on the recipe's quality.

5. Profile Page:
    - Visit the profile page to access all your saved recipes in one place. Easily manage your favorite recipes and organize them as needed.

6. Advanced Search Feature:
    - Use the advanced search feature on the search page to find recipes based on specific criteria such as author, course (e.g., starter, main course, dessert), diet (e.g., vegetarian, vegan), and recipe ingredients.
    - Refine your search results further by specifying sorting options such as preparation time, cooking time, added date, and author.

7. Filter Feature:
    - The search results page integrates a filter feature, allowing you to narrow down the displayed recipes based on diet, course, and author.
    - Use the dropdown menus to select desired filters and instantly update the search results.


## Repository
The project repository can be found at https://github.com/shingchan95/CSCK543_EMA_Recipe_Application.

## License
This project is licensed under the MIT License.
# Weather-Information-Application-using-AJAX
Description:
This is a simple web application that allows users to search for weather information based on city names. The application utilizes AJAX to fetch weather details asynchronously from the server without reloading the page.

## Features:

Search for countries, states, and cities dynamically.
Fetch weather information for selected cities using AJAX.
Display temperature and weather description on the webpage.

## Prerequisites:

Web server (e.g., Apache, Nginx) with PHP support.
MySQL database (or any other database) to store country, state, and city data.

## Installation:

Clone the repository to your local machine:

    git clone https://github.com/example/weather-information-app.git

Set up the database:
Import the provided SQL file (e.g., new.sql) to create the necessary tables for countries, states, and cities.
Configure the database connection settings in the database.php file.

## Usage:

1. Install XAMPP: Download and install XAMPP from https://www.apachefriends.org/index.html based on your operating system.
2. Importing SQL File in phpMyAdmin: Access phpMyAdmin by navigating to `http://localhost/phpmyadmin` in your browser. Create a new database, e.g., 'new'. Import the provided SQL file into the newly created database.
3. Changing Database Configuration in database.php: Open 'database.php' and update the database connection parameters based on your XAMPP setup (username, password, database name). Save the changes.
4. Accessing the City Names Dashboard: Place the 'index.php' file in the 'htdocs' directory of your XAMPP installation (e.g., `C:\xampp\htdocs\`). Open your web browser and navigate to `http://localhost/index.php`.

## File Structure:

    index.php: Main HTML file containing the user interface.
    database.php: PHP file for database connection and operations.
    ajax/: All ajax apis.
    css/: Directory containing CSS files for styling.
    js/: Directory containing JavaScript libraries (e.g., jQuery).
    sql/: SQL file for database

## Live Link:
Link of Deployed application: https://develpment.wuaze.com/dev/ajax/

## Contributing:

Contributions are welcome! Feel free to fork the repository and submit pull requests for improvements or bug fixes.

## License:
This project is licensed under the MIT License.

## Author:
Muhammad Usman Bin Farid

## Contact:
For any inquiries or support, please contact ubf16371@gmail.com.

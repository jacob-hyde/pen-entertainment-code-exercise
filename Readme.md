# Pen Entertainment Code Exercise

### Description
This is a simple PHP application in the Slim Framework that uses a MySQL database to store and retrieve user data.
Docker is used to run the application and the database. Some basic feature tests are included to test the API endpoints.

### Installation
1. Clone the repository
2. Run `docker-compose up -d` to start the application

### Testing
Run the phpunit tests from your local machine, as they are looking to use localhost to connect to the site. (this could be changed to use Docker).
1. run `./vendor/bin/phpunit tests` in the app directory

### Thoughts & Possible Changes
- Could add error handling for failed database statements.
- Validation could be more streamlined, so there is no repetitive checking for errors and handling them within each controller method.
- The `$pdo = $this->databaseService->connect();` you see in the UserRepository for each function could be put into a magic method prior to calling any DB related functions, or it could go into the constructor.
- Add some actual "unit" tests to test database functionality, and not just the controllers.
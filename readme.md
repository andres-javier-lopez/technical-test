## Installation instructions

This software requires php, composer and sqlite support as minimum requirements to run. This instructions
have been created using a `bash` console as the configuration tool.

### Software installation

To install the software follow the following instructions:
* Run `composer install` on the directory to download and install the project dependencies.
* Create a copy of `.env.example` file called `.env`.
* Generate the project key running `php artisan key:generate`.
* Is recommended that you run the software on a sqlite database. This are the instructions to configure sqlite as the project database:
* * Modify `.env` and set `DB_CONNECTION` to `sqlite`. Delete lines 10 - 14 with additional database information.
* * Create an empty database file, you can use the command `touch database/database.sqlite`.
* Install the database running `php artisan migrate --seed`. This will create the database and populate it with default data.
* Generate the keys for the API client running `php artisan passport:install`.
* Generate the clients for the API using `php artisan passport:client`. Use the following data for the admin client: user Id = 1, client = admin, callback = http://localhost:8000. For the regular cliente use: user Id = 2, client = test, callback = http://localhost:8000. You should take note of the client secrets.
* Start the server with `php artisan serve`. Project should be running on http://localhost:8000.

### API test environment

To test the API using Postman, you should do the following:
* On the Authorization tab, select OAuth 2.0 and click on `Get New Access Token`. Use the following data:
* * Callback URL: http://localhost:8000
* * Auth URL: http://localhost:8000/oauth/authorize
* * Access Token URL: http://localhost:8000/oauth/token
* * Use Client ID and Client Secret generated during installation for the admin and regular users.
* * You will need to log into the application. User credentials for admin are: admin@email.com with password **123456**, and for regular user are: test@email.com with password **123456**. You should generate a token for each user.
* The application also need a CSRF token. For this applicaton purposes, you can consult the CSRF token on http://localhost:8000/csrf. You should get the token from inside Postman.
* Add a new header to Postman requests `X-CSRF-TOKEN` with the token information.

### API endpoints

The API has the following endpoints:
* GET http://localhost:8000/products to show the list of all available products. This is available without authentication.
* POST http://localhost:8000/products/new to insert a new product. This is only available with an administrator account.
* GET http://localhost:8000/products/<product_id> to obtain the information of an individual product. This is available without authentication.
* POST http://localhost:8000/<product_id>/like to like a product with the authenticated user.
* POST http://localhost:8000/<product_id>/unlike to eliminate the like of a product with the authenticated user.

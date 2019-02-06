## Installation instructions

This software requires **php**, **composer** and **sqlite** support as minimum requirements to run. This instructions
have been created using a `bash` console as the configuration tool.

### Software installation

To install the software follow the following instructions:
* Run `composer install` on the directory to download and install the project dependencies.
* Create a copy of `.env.example` file called `.env`.
* Generate the project key running `php artisan key:generate`.
* Is recommended that you run the software on a sqlite database. This are the instructions to configure sqlite as the project database:
  * Modify `.env` and set `DB_CONNECTION` to `sqlite`. Delete lines 10 - 14 with additional database information.
  * Create an empty database file, you can use the command `touch database/database.sqlite`.
* Install the database running `php artisan migrate --seed`. This will create the database and populate it with default data.
* Generate the keys for the API client running `php artisan passport:install`.
* Start the server with `php artisan serve`. Project should be running on http://localhost:8000.

### API test environment

To test the API using Postman, you should do the following:
* Obtain a personal access token on http://localhost:8000/request-token. You should generate a token for admin and regular user. Admin user is `admin@email.com` and regular user is `test@email.com`. Both passwords are **123456**.
* On the Authorization tab, select OAuth 2.0 and paste the personal access token previously obtained.
* The application also need a CSRF token. For this applicaton purposes, you can consult the CSRF token on http://localhost:8000/csrf. You should get the token from inside Postman. Add a new header to Postman requests `X-CSRF-TOKEN` with the token information.

### API endpoints

The API has the following endpoints:
* GET http://localhost:8000/products to show the list of all available products. This is available without authentication.
  * You can send the _order_ parmeter to sort the list by _popularity_ or _name_.
  * You can send the _search_ parameter to search the products by name.
  * You can send the _page_ parameter to paginate the results.
* POST http://localhost:8000/products/new to insert a new product. Fields are _name_, _description_, _price_ and _stock_. This is only available with an administrator account.
* GET http://localhost:8000/products/{product_id} to obtain the information of an individual product. This is available without authentication.
* PUT http://localhost:8000/products/{product_id} to modify an existing product. Values that can be modified are _name_, _description_, _price_ and _stock_. This is only available with an administrator account.
* DELETE http://localhost:8000/products/{product_id} to delete an existing product. This is only available with an administrator account.
* POST http://localhost:8000/products/{product_id}/purchase to purchase a product. The purchase _quantity_ is sent as a parameter.
* POST http://localhost:8000/{product_id}/like to like a product with the authenticated user.
* POST http://localhost:8000/{product_id}/unlike to eliminate the like of a product with the authenticated user.
* GET http://localhost:8000/purchase_history to get a list of all purchases.
* GET http://localhost:8000/price_history to get a list of all the price modifications.

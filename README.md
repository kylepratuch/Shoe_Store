# Shoe_Store

##### _In-browser shoe store management app, 8/28/2015_

#### By _Kyle Pratuch_

## Description

_Shoe store allows users to add, edit, and delete shoe stores to a database. Shoe brands may also be added. Stores may carry many brands, and brands may be carried at many stores._

## Setup

 1. Clone this repository: run command ```git clone https://github.com/kylepratuch/Shoe_Store.git ``` then change directory to top level of project folder.
 2. Use Composer to install dependencies: run command ```composer install ``` to download vendor files for Silex, Twig, and PHPUnit (if you wish to run the included tests).
 3. A local SQL server is needed to run the app.
    In your terminal: ```mysql.server start``` followed by ```mysql -root -proot```.
    If you would like to create the databases from scratch, use the following commands:

```console
> CREATE DATABASE shoes;
> USE shoes;
> CREATE TABLE stores (store_name VARCHAR (255), id serial PRIMARY KEY);
> CREATE TABLE brands (brand_name VARCHAR (255), id serial PRIMARY KEY);
> CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY);
```

If you would like to run the included tests, copy to shoes_test using phpmyadmin.
Be sure are using the correct server address in app/app.php, tests/StoreTest.php, and tests/BrandTest.php!
 4. Start your server in the '/web' folder: to use PHP's built-in server, run command ```php -S localhost:8000```.
 5. View the app: in your browser, navigate to the home page at the root address. If running a server as described above, go to 'http://localhost:8000'.

## Technologies Used

_PHP, Composer (Silex, Twig, PHPUnit), MAMP, MySQL_

### Legal

Copyright (c) 2015 Kyle Pratuch

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

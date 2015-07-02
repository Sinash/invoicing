# invoicing
Invoicing application using Laravel

##How to install:
* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)

-----
<a name="step1"></a>
### Step 1: Get the code - Download/Clone the repository the repository

    https://github.com/Sinash/invoicing.git

Extract it in www(or htdocs if you using XAMPP) folder. You can setup a virtual host if needed.

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies

On Windows, you can use the Composer [Windows installer](https://getcomposer.org/Composer-Setup.exe).

Then run:

    composer install
to install dependencies Laravel and other packages.

-----
<a name="step3"></a>
### Step 3: Create database

Create database on your database server(MySQL). You must create database with utf-8 collation(uft8_general_ci), to install and application work perfectly.
After that, copy .env.example and rename it as .env and put connection and change default database connection name, only database connection, put name database, database username and password.

-----
<a name="step4"></a>
### Step 4: Install

Make sure node.js is installed in your system using the below command. Else install it from https://nodejs.org/

    node -v

Install dependencies listed in package.json with:

    npm install

Retrieve frontend dependencies with Bower, compile SASS, and move frontend files into place:

    gulp

Now that you have the environment configured, you need to create a database configuration for it. For create database tables use this command:

    php artisan migrate

And to initial populate database use this:

    php artisan db:seed

If you have configured the appication in your localhost using virtual host under the port say for example 9999, you can access the application at 

	http://localhost:9999
-----
<a name="step5"></a>
### Step 5: Start Page

You can now login to admin part of Laravel Framework 5  Bootstrap 3 Starter Site:

    username: sinash@gmail.com
    password: admin123
OR user

    username: aleena@gmail.com
    password: user123
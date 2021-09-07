#Bincom Dev Interview solution

This is the solution to the Bincom dev interview problem.
##Technologies used
- Bootstrap 5
- Postgresql for data storage
- Laravel 8

* Note - The sql data provided in /bincom_test.sql have been tweaked to fit EloquentORM structure requirements .Some table and column names have been changed to fit the requirements.

##Installation process
###Clone from git
```git clone https://github.com/narhzih/bincom-dev-sol.git```
###Create .env file
Change directory to the actual project folder by running the following code on your terminal:
```cd ./bincom-dev-sol``` (if you explicitly specified a separate name during git clone, replace "bincom-dev-sol" with the name of the folder )
From your project root folder, run:
```cp .env.example .env``` (this command will create a .env file from the existing .env.example file)
###Create Application key
From your project root folder, run:
```php artisan key:generate```
###Create migration and seed
Connect the application with your database by editing the database section of your .env file (Note that pgsql was used instead of mysql).
After connecting, run:
```php artisan migrate``` to create migrations
then run:
```php artisan db:seed``` to fill the created tables with required data

###Run application
In your terminal, in your project root folder run:
```php artisan serve```. This command should start up a server @ http://127.0.0.1:8000


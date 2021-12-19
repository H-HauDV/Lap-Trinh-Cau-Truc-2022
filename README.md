## Report here: 
Link to group drive: [driveSP_03](https://drive.google.com/drive/folders/1uJG-OQVU2W3jJvizpzOXTNWRu22nPT-g?usp=sharing)

- Week 1-3 report --> SP_W3

- Week 4 (cards) --> SP_W4

## Install instruction:
-Step 1: Clone project.
Install composer dependencies
```
composer require jenssegers/mongodb
composer install
```
-Step 2: Create database with mongodb.
* Create database in mongodb with name "LTCT"
* copy file .env from https://drive.google.com/file/d/1s4HFIt7xKKsUshZyCCEJ7uwdg-_UUOvQ/view?usp=sharing and copy to main folder
* Migrate database
```
php artisan migrate 
```
* Start local server
```
php artisan serve 
```

## API list:
1. API for get/set role
* GET: 'api/user/get-role/from-id'
* POST: 'api/user/set-role/for-id'
2. API for get/set payment config
* GET: 'api/paymentConfig/get'
* POST: 'api/paymentConfig/set'
3. API for get/set notification config
* GET 'api/notificationConfig/get'
* POST 'api/notificationConfig/set'
4. API for get/set screen config
* GET 'api/user/get-screen-config/from-id'
* POST 'api/user/set-screen-config/for-id'
5. API for get/set product config
* GET 'api/productconfig/get'
* POST 'api/productconfig/set'
6. API for get/set login config
* GET 'api/loginconfig/get'
* POST 'api/loginconfig/set'

##Database format
/database/seeders

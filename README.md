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
## Base link for api: 
https://ltct-sp03-api.herokuapp.com/ (add this before every api)
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
7. API for get/set module switch
* GET 'api/moduleSwitch/get'
* POST 'api/moduleSwitch/set'

## If you use can't use get with request body use this instead (get but with post method, request body still the same):
1. API for get role
* POST: 'api/user/get-role/for-post'
2. API for get payment config
* POST: 'api/paymentConfig/get/for-post'
3. API for get notification config
* POST: '/notificationConfig/get/for-post'
4. API for get screen config
* POST: 'api/user/get-screen-config/for-post'
5. API for get product config
* POST: 'api/productconfig/get/for-post'
6. API for get login config
* POST: 'api/loginconfig/get/for-post'
7. API for get module switch
* POST: 'api/moduleSwitch/get/for-post'

## Request body format for API and data rules:
https://docs.google.com/spreadsheets/d/1gWZ9ClgkRuQHVVNu-_zj28vho_sOtpSBev-_2IDf1j4/edit?fbclid=IwAR0CxzwStsGxJliCfIEoUN3kt7QZz6xJG_hQmW6VL-RsiLM5Qf9-fm82EFg#gid=0

## Database format
/database/seeders

## Set up

1. git clone https://github.com/ShashikaErandi/login_temperatures.git
2. cd login_temperatures
3. Copy .env.example
4. Rename .env.example to .env
5. Add database configurations
6. Run composer install
7. Run php artisan key:generate
8. Run php artisan migrate
9. Run npm install
10. Run php artisan serve

## Overview of the solution

1. A user can register and login to the platform
2. On each successful login, the current temperature for each city added in the cities.php config file save in the database
3. User can view each temperature in both Celsius (°C) and Fahrenheit (°F) with the login date and time
4. On clicking the “Hottest First” button, user can see the list of temperatures ordered from Hottest to Coldest
5. On clicking the “Reset Order” button, list of temperatures will be reset to chronological order

## Used libraries 

1. Laravel Breeze: for Authentication
2. Vue.js: for dashboard
3. Moment.js: for format date and time
4. Vue-axios: for ajax requests

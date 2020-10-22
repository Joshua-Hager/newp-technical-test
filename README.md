## Setup
Since you mentioned that you use Laradock for development purposes, I decided to leverage it as well. The Laradock FPM container was using PHP 7.3, in case you run into any weird version issues.
1. Git clone the repo
2. In Laradock, start Nginx and MySQL Docker containers. Make sure the Nginx container is pointing to this code.
3. Once Laradock has finished setting up all of the containers, shell into the FPM container. Run `cp .env.example .env` and change the `DB_HOST` to the name of the appropriate MySQL container.
4. Within the MySQL server, create a new database called `newp`.
5. Run the following commands:
- `composer install`
- `php artisan key:generate`
- `php artisan migrate --seed`
- `npm install && npm run watch`
6. At this point you should be able to open a browser tab and view the application. If there are any issues feel free to contact me.
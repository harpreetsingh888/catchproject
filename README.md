catchproject
============

Copy the project into you var/www/html/ directory and change your current directory to /var/www/html/catchproject

     * Run your application:
         1. Execute the php app/console server:run command.
         2. Browse to the http://localhost:8000 URL.

     * Database name is catchproject.
         1. Execute php app/console doctrine:database:create command to generate database named catchproject

     * Generate table
         1. Execute php app/console doctrine:schema:update --force

     * Build assets
         1. Build the assets(css and js) using php app/console assetic:dump

     * Run project
         1. To run the project execute php app/console server:run
         2. In the browser go to http://localhost:8000 or http://127.0.0.1:8000/
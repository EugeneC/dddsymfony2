## Installation

1. If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

2. Install vendors:

    ```
    php composer.phar install
    ```

3. Configure app/config/parameters.yml

4. Please read manual http://symfony.com/doc/current/book/installation.html if you have problems with Symfony2

5. Assets install:

   ```
   php app/console assetic:dump; php app/console assets:install;
   ```

6. Pages generation:

  6.1 Pages with predefined values (home, about, new page)
    ```
    php app/console pages:generate;
    ```
  6.2 Create page with your values
    ```
    php app/console page:generate;
    ```
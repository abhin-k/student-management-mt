## Installation

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/abhin-k/student-management-mt.git
    ```

2. Go into the project root directory
    ```sh
    cd student-management-mt
    ```

3. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
4. Create database and set database credentials in env file

5. Install PHP dependencies
    ```sh
    composer install
    ```

6. Generate key
    ```sh
    php artisan key:generate
    ```

7. install front-end dependencies
    ```sh
    npm install && npm run dev
    ```

8.  Run migration
    ```
    php artisan migrate
    ```

9.  Run seeder
    ```
    php artisan db:seed
    ```
    this command will create a user
     > email: test@example.com , password: password

10. Run server

    ```sh
    php artisan serve
    ```

11. Visit `localhost:8000` in your browser.

## Run Tests

You can run test using phpunit

```sh
    ./vendor/bin/phpunit
```

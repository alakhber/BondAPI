## INSTALLATION
- Run git clone 
- Open Terminal and Run Code
```bash
    git clone https://github.com/alakhber/BondAPI.git
```
- Run cp .env.example .env
- Create a mysql database and edit the ".env" file as you like
- Open Terminal 
```bash
    # Installing Dependencies
    composer install
    # Generate an encryption key
    php artisan key:generate
    # Running Migrations and Seeds
    php artisan migrate --seed
    # Run Project
    php artisan serve
``` 

- Go to link http://127.0.0.1:8000/v1/api/list
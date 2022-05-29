# Test Manager

Prosty system do zarządzania testami.

## Instalacja:

1. Pobierz repozytorium
    ```bash
    git clone https://github.com/usdarys/test-manager.git
    ```

2. Skopiuj `.env.example` do głównego katalogu jako `.env` i uzupełnij dane połączeniowe do bazy swoimi danymi.

3. Wykonaj w katalogu głównym projektu:
    ```bash
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    npm install
    npx mix --production
    ```

## Uruchomienie serwera:
W katalogu głównym projektu wykonaj:
```bash
php artisan serve
```
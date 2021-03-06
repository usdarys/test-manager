# Test Manager

Prosty system do zarządzania testami oparty na frameworku [Laravel](https://laravel.com/).

System oferuje następujące funkcjonalnosci:
- rejestracja zespołów
- obsługa logowania i autoryzacji (rózne poziomy dostępu do wybranych funkcjonalności)
- zarządzanie uzytkownikami w ramach zespolu
- dodawanie projektów w ramach zespołu
- tworzenie bazy przypadków testowych dla kazdego projektu
- tworzenie i wykonywanie przebiegów testowych dla kazdego projektu - podgląd statusów wykonania poszczególnych testów i wgląd w statystyki

## Wymagania:
1. [php 8+](https://www.php.net/downloads)
2. [composer](https://getcomposer.org/)
3. [Node.js + npm](https://nodejs.org/en/)
4. [Postgres](https://www.postgresql.org/) (teoretycznie powinno działac na wszystkich bazach [wspieranych przez laravel](https://laravel.com/docs/9.x/database#introduction) ale testowane tylko na postgres)

## Instalacja:

1. Nalezy pobrac repozytorium
    ```bash
    git clone https://github.com/usdarys/test-manager.git
    ```

2. Skopiowac `.env.example` do głównego katalogu jako `.env` i uzupełnic dane połączeniowe do bazy swoimi danymi.

3. Upewnic się, ze na serwerze jest zainstalowany i włączony w `php.ini` odpowiedni moduł do obsługi bazy danych. Przykładowo dla postgresa powinno byc coś mniej więcej takiego:
    ```
    extension=php_pgsql.so
    ```

4. Wykonac w katalogu głównym projektu:
    ```bash
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    npm install
    npx mix --production
    ```

## Uruchomienie serwera aplikacji:
W katalogu głównym projektu nalezy wykonac:
```bash
php artisan serve
```
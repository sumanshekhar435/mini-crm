# Mini CRM Project

This is a mini CRM project built with Laravel.

## Installation

1. Clone the project:
   git clone https://github.com/sumanshekhar435/mini-crm.git

2. Rename `.env.example` to `.env`:

3. Update `.env` file:
   Set the `DB_DATABASE` to `mini_crm`.
   DB_DATABASE=mini_crm

4. Install Composer dependencies:
   composer install

5. Generate Application Key:
   php artisan key:generate

6. Run Database Seeder:
   php artisan db:seed --class=AdminUserSeeder

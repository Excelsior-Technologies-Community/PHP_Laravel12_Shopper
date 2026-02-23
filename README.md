# PHP_Laravel12_Shopper

##  Project Introduction

PHP_Laravel12_Shopper is a Laravel 12 based Headless eCommerce Admin System built using the official Shopper Framework.

This project demonstrates how to integrate and configure Shopper properly within a fresh Laravel 12 application to create a scalable, production-ready eCommerce backend.

It focuses on clean architecture, correct installation practices, and modern headless development principles.


## Project Objectives

- Implement Shopper in Laravel 12 following official standards

- Configure database and media management

- Setup role-based admin authentication

- Structure a clean Laravel application

- Prepare a scalable headless commerce backend

- Document production-ready deployment steps

---

## Project Overview

PHP_Laravel12_Shopper provides a complete backend administration system for managing an eCommerce platform using Laravel 12 and the Shopper Framework.

The application includes a fully functional control panel (/cpanel) that enables administrators to manage:

- Products and product variants

- Categories and collections

- Customers and user roles

- Orders and order status tracking

- Discounts and promotional rules

- Media assets and file uploads

- Store configuration settings

The project follows best practices in Laravel application structure and demonstrates how to extend core models (such as the User model) to integrate with Shopper’s built-in role, permission, and media systems.

This implementation serves as a backend engine that can power:

- Custom web storefronts

- Single Page Applications (SPA)

- Mobile applications

- API-driven commerce platforms

By separating business logic from presentation, the system ensures scalability, maintainability, and flexibility for future growth.

---

##  System Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Laravel 12
- Web server (Apache / Nginx)

---

##  Step 1: Create Laravel 12 Project

Create a fresh Laravel project:

```bash
composer create-project laravel/laravel PHP_Laravel12_Shopper "12.*"
```

Move inside project:

```bash
cd PHP_Laravel12_Shopper
```

Check Laravel version:

```bash
php artisan --version
```

Make sure it shows Laravel 12.x

---

##  Step 2: Configure Environment

Open `.env` file and update database configuration:

```env
DB_DATABASE=shopper_db
DB_USERNAME=root
DB_PASSWORD=
```

Now create database manually:

```sql
CREATE DATABASE shopper_db;
```

or 

run migration command:

```bash
php artisan migrate
```

---

## Step 3: Fix Missing intl Extension (Required Anyway)

Even if you upgrade PHP, you must enable intl.

Step:

Open:

```
D:\xampp\php\php.ini
```

Find this line:

```
;extension=intl
```

Remove the semicolon:

```
extension=intl
```

Save file.

Restart Apache.

Then verify:

```
php -m
```

You should see:

```
intl
```

---


##  Step 4: Install Shopper Framework (Official Method)

Install Shopper package:

```bash
composer require shopper/framework
```

After installation, run the official install command:

```bash
php artisan shopper:install
```

This command will automatically:

- Publish configuration files
- Publish migrations
- Setup media management
- Setup permissions
- Install admin panel
- Configure required services
- Seed initial data

This is the correct official installation method.

---

##  Step 5: Run Migrations

Run:

```bash
php artisan migrate
```

This will create tables like:

- users
- shopper_products
- shopper_categories
- shopper_orders
- shopper_customers
- shopper_collections
- media tables
- permission tables

---

##  Step 6: Install Frontend Assets

Install Node dependencies:

```bash
npm install
```

Build assets:

```bash
npm run build
```

---

## Step 7 — Modify Your User Model

Open this file:

```
app/Models/User.php
```

Right now it probably looks like:

```
use Illuminate\Foundation\Auth\User as Authenticatable;
```

You must change it to:

```
use Shopper\Core\Models\User as ShopperUser;
```

Then modify the class like this:

```php
<?php

namespace App\Models;

use Shopper\Core\Models\User as ShopperUser;

class User extends ShopperUser
{
    //
}
```

### Why This Is Required?

Shopper's User model already includes:

- Role management

- Permission system

- Media handling

- Admin logic

If you don't extend it, admin panel will not work correctly.

---

## Step 8 — Clear Cache (Important)

Run:

```bash
php artisan optimize:clear
```

---

## Step 9 — Create Admin User

Now run:

```bash
php artisan shopper:user
```

It will ask:

- Email

- First Name

- Last Name 

- Password

Fill it carefully.

---

## Step 10 — Storage Link (Very Important)

Run:

```bash
php artisan storage:link
```

If not linked, media & assets may fail.

---

##  Step 11: Run the Application

Start server in First Terminal:

```bash
php artisan serve
```

In Second Terminal:

```bash
npm run build
npm run dev
```

Open in browser:

```
http://127.0.0.1:8000/cpanel/login
```

Login using your admin credentials.

---

## Output

### Shopper Login

<img width="1919" height="1026" alt="Screenshot 2026-02-23 114500" src="https://github.com/user-attachments/assets/e50b1dc1-0d98-49d4-8971-8cb31749bc7f" />

### Shopper Dashboard

<img width="1919" height="1029" alt="Screenshot 2026-02-23 115534" src="https://github.com/user-attachments/assets/bf4599cd-a1b7-4749-96fa-cbd7e5fddecc" />

---

##  Project Structure 

```
PHP_Laravel12_Shopper/
│
├── app/
│   ├── Http/
│   ├── Models/
│   │   └── User.php
│   ├── Providers/
│
├── bootstrap/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   ├── session.php
│   │
│   └── shopper/
│       ├── admin.php
│       ├── auth.php
│       ├── core.php
│       ├── features.php
│       ├── media.php
│       ├── models.php
│       ├── orders.php
│       ├── routes.php
│       └── settings.php
│
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── 2026_02_23_055332_create_media_table.php
│   ├── seeders/
│
├── public/
├── resources/
├── routes/
│   └── web.php
│
├── storage/
├── vendor/
│   └── shopper/
│
├── .env
├── artisan
├── composer.json
└── package.json
```

---

Your PHP_Laravel12_Shopper Project is Now ready!


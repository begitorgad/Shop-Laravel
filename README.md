# ShopLaravel

ShopLaravel is a small e-commerce web application built with Laravel.  
It demonstrates a typical online store architecture including product management, categories, shopping cart logic, authentication, and order handling.

The goal of this project is to practice building a full-stack CRUD application using Laravel while applying common backend patterns such as models, relationships, scopes, and service logic.

---

## Features

- User authentication
- Product listing and product details
- Product categories
- Shopping cart system
- Order creation
- Admin product management
- Admin category management
- Image handling for products
- Database relationships (products, categories, users, orders)

---

## Tech Stack

- PHP 8.2
- Laravel 12
- MySQL
- Vite
- Blade templates

---

## Project Structure

Key directories:

app/
Models/
Http/
Services/
routes/
web.php
resources/
views/
database/
migrations/


The project follows Laravel’s MVC architecture.

---

## Installation

### 1. Install dependencies

```
composer install
npm install
```

### 2. Environment configuration

Copy the environment file:

```
cp .env.example .env
```

Update the database settings inside `.env`:

```
DB_DATABASE=shoplaravel
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Generate the application key

```
php artisan key:generate
```

### 4. Run database migrations

```
php artisan migrate
```

(Optional) Seed the database

```
php artisan db:seed
```

### 5. Build frontend assets

```
npm run dev
```

### 6. Start the development server

```
php artisan serve
```

The application will be available at:

```
http://localhost:8000
```

---

## Example Workflow

1. Register or login as a user
2. Browse products
3. Add products to the cart
4. Place an order
5. Admin users can manage products and categories

---

## License

This project is for educational purposes.

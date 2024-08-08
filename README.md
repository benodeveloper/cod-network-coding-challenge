# This is a coding challenge from COD NETWORK

---

# Product Management System

A web application for managing products and categories, including functionality for creating, deleting, and browsing products with pagination. This project is built using Laravel for the backend and Vue.js with TypeScript for the frontend.

## Table of Contents

- [Features](#features)
- [Technologies](#technologies)
- [Setup](#setup)
- [API Endpoints](#api-endpoints)
- [Frontend](#frontend)
- [Testing](#testing)

## Features

- **Backend (Laravel)**
  - Create, and delete products and categories.
  - Paginated product listing with sorting and filtering.

- **Frontend (Vue.js)**
  - Form for creating products.
  - Paginated product listing.
  - Image upload functionality.

## Technologies

- **Backend**: Laravel 10, PHP (8.1.28), MySQL
- **Frontend**: Vue.js, TypeScript
- **Image Storage**: Local storage

## Setup

### Backend

1. Clone the repository:

   ```bash
   git clone https://github.com/benodeveloper/cod-network-coding-challenge.git
   cd cod-network-coding-challenge/backend
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Set up the environment file:

   ```bash
   cp .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Run the migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

6. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

### Frontend

1. Clone the repository:

   ```bash
   git clone https://github.com/benodeveloper/cod-network-coding-challenge.git
   cd cod-network-coding-challenge/frontend
   ```

2. Install dependencies:

   ```bash
   npm install
   ```

3. Start the Vue development server:

   ```bash
   npm run dev
   ```

## API Endpoints

- **Products**
  - `GET /api/products`: List all products with pagination.
  - `POST /api/products`: Create a new product.

- **Categories**
  - `GET /api/categories`: List all categories.

## Frontend

The frontend application is built with Vue.js and TypeScript. It includes:

- **ProductForm.vue**: A form for creating products.
- **ProductList.vue**: Displays a paginated list of products with sorting and filtering.

### Functionality

- **Create Product**: Allows users to input product details and upload an image.
- **Product List**: Displays products with pagination, sorting by name and price, and filtering by category.

## Testing

Backend testing can be done using PHPUnit. Run tests with:

```bash
php artisan test
```

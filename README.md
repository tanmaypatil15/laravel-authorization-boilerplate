# Laravel Roles and Permissions Boilerplate

A basic Laravel project demonstrating the setup and usage of the **Spatie Roles and Permissions** package.  
Easily manage user roles, permissions, and protect routes using middleware.

---

## Features

- User Authentication (Laravel Breeze)
- Role-based access control
- Permission management
- Middleware protection for routes
- Example Seeders for roles and permissions
- Example usage in controllers and views

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure Environment**
   - Copy `.env.example` to `.env`
   - Update database credentials in `.env`

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Run the App**
   ```bash
   php artisan serve
   ```

---

## Default Credentials (Optional)

| Role   | Email                  | Password  |
|--------|-------------------------|-----------|
| Admin  | admin@example.com        | password  |
| User   | user@example.com         | password  |

---

## Tech Stack

- Laravel 10 (or your version)
- Spatie Laravel-Permission (v5.x or your version)
- MySQL / SQLite (any database)
- (Optional) TailwindCSS / Bootstrap (mention if any front-end)

---

## License

This project is open-source and available under the [Apache-2.0 license](LICENSE).

---
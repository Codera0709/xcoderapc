# Laravel Internal Application

Scaffolding untuk aplikasi internal dengan sistem role-based access control menggunakan Spatie Laravel Permission.

## Requirements

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL Database
- Laragon (atau web server lainnya)

## Roles & Permissions

Aplikasi ini memiliki 5 role dengan level akses berbeda:

### 1. SuperAdmin
- Full access ke semua fitur
- Dapat manage roles & permissions
- Dapat view system logs

### 2. Admin
- Manage users (create, edit, delete)
- Manage settings
- Full access reports & analytics
- View logs

### 3. Employee
- View users
- View & create reports
- View analytics
- View settings (read-only)

### 4. Public
- View reports
- View analytics

### 5. Guest
- View reports only

## Installation

### 1. Clone & Install Dependencies

```bash
composer install
npm install
```

### 2. Environment Setup

```bash
# Copy .env.example ke .env
copy .env.example .env

# Update konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xcoderapcnew
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Database Setup

```bash
# Buat database 'xcoderapcnew' di MySQL
# Kemudian jalankan migrasi dan seeder

php artisan migrate
php artisan db:seed
```

### 5. Build Assets

```bash
npm run build
```

## Development

### Menjalankan Development Server

```bash
# Opsi 1: Menggunakan composer script (recommended)
composer dev

# Opsi 2: Manual
php artisan serve
npm run dev
```

### Default Users

Setelah seeding, Anda dapat login dengan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| SuperAdmin | superadmin@example.com | password |
| Admin | admin@example.com | password |
| Employee | employee@example.com | password |
| Public | public@example.com | password |
| Guest | guest@example.com | password |

## Usage

### Menggunakan Role di Routes

```php
// Hanya SuperAdmin
Route::get('/admin/system', [SystemController::class, 'index'])
    ->middleware(['auth', 'role:SuperAdmin']);

// SuperAdmin atau Admin
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'role:SuperAdmin,Admin']);
```

### Menggunakan Permission di Routes

```php
Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'permission:view users']);
```

### Menggunakan di Blade Templates

```blade
@role('SuperAdmin')
    <a href="/admin/system">System Settings</a>
@endrole

@hasrole('SuperAdmin|Admin')
    <a href="/admin/users">Manage Users</a>
@endhasrole

@can('edit users')
    <button>Edit User</button>
@endcan
```

### Menggunakan di Controller

```php
// Check role
if (auth()->user()->hasRole('SuperAdmin')) {
    // Do something
}

// Check permission
if (auth()->user()->can('edit users')) {
    // Do something
}

// Assign role
$user->assignRole('Admin');

// Give permission
$user->givePermissionTo('edit users');
```

## Testing

```bash
composer test
```

## Features

### 🎨 Modern UI/UX
- **Redesigned Authentication Pages**: Login, Register, Forgot Password, Reset Password
- **Modern Profile Page**: With avatar, role badges, and organized sections
- **Split Screen Layout**: Beautiful gradient illustrations on auth pages
- **Password Toggle**: Show/hide password functionality
- **Dark Mode Ready**: All pages support dark mode
- **Fully Responsive**: Mobile-first design approach

### 🔐 Security & Authorization
- **Role-Based Access Control**: 5 roles with different permission levels
- **Spatie Laravel Permission**: Industry-standard authorization package
- **Email Verification**: Built-in email verification system
- **Password Reset**: Secure password reset flow

### 📊 Dashboard & Analytics
- **Interactive Dashboard**: Stats cards, charts, and activity timeline
- **User Management**: CRUD operations for users with role assignment
- **Reports & Analytics**: Pre-built pages for data visualization

## Tech Stack

- **Framework**: Laravel 12
- **Authentication**: Laravel Breeze (Redesigned UI)
- **Authorization**: Spatie Laravel Permission
- **Frontend**: Tailwind CSS 3, Alpine.js, Vite
- **Database**: MySQL
- **Testing**: PHPUnit

## Project Structure

```
app/
├── Http/
│   ├── Controllers/     # Controllers
│   ├── Middleware/      # Custom middleware (RoleMiddleware)
│   └── Requests/        # Form requests
├── Models/              # Eloquent models
└── Providers/           # Service providers

database/
├── migrations/          # Database migrations
└── seeders/            # Database seeders
    └── RolePermissionSeeder.php

resources/
├── css/                # Stylesheets
├── js/                 # JavaScript files
└── views/              # Blade templates

routes/
├── web.php             # Web routes
└── auth.php            # Authentication routes
```

## License

MIT License

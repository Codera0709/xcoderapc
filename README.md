<p align="center">
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/license-MIT-brightgreen" alt="License"></a>
</p>

## XCODERA Dashboard

XCODERA is a premium modular dashboard built with Laravel 12.x using the TALL stack (Tailwind CSS, Alpine.js, Laravel, Blade).

## Features

- **Modern UI/UX**: Built with Tailwind CSS for beautiful, responsive design
- **Interactive Elements**: Powered by Alpine.js for dynamic interactions
- **User Management**: Full CRUD operations for user management
- **Role-based Access**: Different permission levels (admin, editor, viewer)
- **Dark Mode**: Seamless dark/light mode toggle with persistent preferences
- **Dashboard Analytics**: Visual data representation with charts and statistics
- **Responsive Design**: Works on all device sizes
- **Premium Components**: Advanced UI components like modals, notifications, etc.
- **Command Palette**: Quick access to features with Ctrl+K
- **Chat Widget**: Integrated support chat functionality

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/xcodera.git
   cd xcodera
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install NPM dependencies:
   ```bash
   npm install
   ```

4. Copy the environment file and set your database credentials:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=xcodera
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```

7. Run database migrations:
   ```bash
   php artisan migrate
   ```

8. Build frontend assets:
   ```bash
   npm run build
   ```

9. Start the development server:
   ```bash
   php artisan serve
   ```

## Development

To work on the frontend assets during development:

1. Start the Vite development server:
   ```bash
   npm run dev
   ```

2. In another terminal, start the Laravel development server:
   ```bash
   php artisan serve
   ```

## Components Documentation

For detailed documentation of the reusable components, please see the files in the [resources/docs/components/](resources/docs/components/) directory.

## Testing

Run the test suite:
```bash
php artisan test
```

## Directory Structure

```
resources/
├── views/
│   ├── components/          # Reusable UI components
│   │   ├── layout/          # Layout components (navbar, sidebar, etc.)
│   │   ├── ui/              # Basic UI elements (button, card, modal, etc.)
│   │   ├── form/            # Form components
│   │   ├── data/            # Data display components (table, chart, etc.)
│   │   └── utils/           # Utility components
│   └── pages/               # Page templates
│       ├── dashboard/
│       ├── users/
│       ├── settings/
│       └── reports/
```

## Deployment

To deploy XCODERA to production, please follow the instructions in the [deployment guide](resources/docs/deployment.md).

## Contributing

Thank you for considering contributing to XCODERA! Please submit a pull request with a detailed explanation of your changes.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
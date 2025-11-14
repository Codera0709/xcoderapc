# Deployment Guide for XCODERA

This document provides instructions for deploying your XCODERA application to production.

## Prerequisites

- Web server (Apache, Nginx, etc.)
- PHP 8.2 or higher
- Composer
- Node.js and npm
- Database (MySQL, PostgreSQL, or SQLite)

## Pre-Deployment Steps

### 1. Environment Configuration

Make sure your `.env` file is properly configured:

```env
APP_NAME=XCODERA
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database
```

Generate the application key:
```bash
php artisan key:generate
```

### 2. Frontend Asset Build

Build the frontend assets for production:

```bash
npm run build
```

This command will compile and minify all CSS and JavaScript assets using Vite.

### 3. Optimizations

Optimize the application for production:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 4. Database Migration

Run the database migrations to set up your database tables:

```bash
php artisan migrate --force
```

> Note: The `--force` flag is required to run migrations in production.

## Server Configuration

### Apache (.htaccess)

Ensure your web server has the following rewrite rules (typically handled by Laravel's default `.htaccess` file in the `public` directory):

```
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

### Nginx

If using Nginx, configure it to serve your Laravel application:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/your/xcdodera/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Deployment Process

1. Upload your application files to your server
2. Install PHP dependencies with `composer install --no-dev --optimize-autoloader`
3. Configure your environment variables
4. Run the pre-deployment steps mentioned above
5. Set proper file permissions:
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 755 storage bootstrap/cache
   ```
6. Test your deployment by visiting your domain

## Post-Deployment

After deployment, consider these additional steps:

1. **Set up automatic backups** for your database
2. **Configure monitoring** for your application
3. **Set up SSL certificate** for HTTPS
4. **Configure a task runner** for scheduled commands (cron jobs)
5. **Set up error tracking** and logging

## Rollback Plan

If you need to rollback to a previous version:

1. Restore the previous application files
2. Rollback the database (if needed) with `php artisan migrate:rollback`
3. Clear caches with `php artisan cache:clear`

## Troubleshooting

### Common Issues

- **500 Internal Server Error**: Check file permissions and error logs
- **404 Not Found**: Ensure rewrite rules are properly configured
- **Missing Assets**: Verify that `npm run build` was executed and assets are in place

### Logs

Check Laravel logs in `storage/logs/laravel.log` for application errors.

## Deployment Commands Summary

```bash
# Build frontend assets
npm run build

# Cache configuration
php artisan config:cache

# Run migrations
php artisan migrate --force

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```
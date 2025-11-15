<div align="center">

# XCODERA Dashboard

### Premium Modular Dashboard System
**Built with Laravel 12 & TALL Stack**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

---

**A modern, responsive, and feature-rich dashboard built for scalability and developer experience.**

[Features](#-features) • [Installation](#-installation) • [Documentation](#-documentation) • [Demo](#-demo) • [Contributing](#-contributing)

</div>

---

## 🚀 Features

### Core Features
- **🎨 Modern UI/UX** - Beautiful, responsive design with Tailwind CSS
- **⚡ Interactive Elements** - Powered by Alpine.js for seamless interactions
- **🔐 Authentication System** - Laravel Breeze integration with email verification
- **👥 User Management** - Complete CRUD operations with role-based access control
- **🌓 Dark Mode** - Persistent theme switching with smooth transitions
- **📊 Analytics Dashboard** - Visual data representation with Chart.js
- **📱 Fully Responsive** - Works flawlessly on all device sizes

### Premium Components
- **🎯 Command Palette** - Quick access with `Ctrl+K`
- **💬 Chat Widget** - Integrated support functionality
- **🔔 Notification Center** - Real-time notification system
- **🎭 Theme Drawer** - Advanced theme customization
- **🎪 Skeleton Loaders** - Smooth loading states
- **📋 Data Tables** - Advanced filtering and pagination
- **📈 Chart Integration** - Interactive charts with Chart.js
- **🎨 Premium Animations** - Smooth transitions and micro-interactions

### Developer Experience
- **📦 Modular Architecture** - Reusable components structure
- **🧪 Testing Ready** - PHPUnit/Pest configured with feature tests
- **📚 Component Documentation** - Detailed docs for all components
- **🔧 Developer Tools** - Vite for fast HMR, Alpine DevTools support
- **🎯 Type Safety** - Laravel Pint for code formatting

---

## 🛠️ Tech Stack

| Category | Technology |
|----------|-----------|
| **Backend** | Laravel 12.x, PHP 8.2+ |
| **Frontend** | Blade Templates, Tailwind CSS 3.x, Alpine.js 3.x |
| **Database** | MySQL / PostgreSQL / SQLite |
| **Build Tool** | Vite 5.x |
| **Charts** | Chart.js |
| **Testing** | PHPUnit, Pest |
| **Authentication** | Laravel Breeze |

---

## 📦 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js >= 18.x
- MySQL / PostgreSQL / SQLite

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Codera0709/xcodera.git
   cd xcodera
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database** (Edit `.env`)
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=xcodera
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database** (Optional)
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

10. **Access the application**
    ```
    http://localhost:8000
    ```

---

## 🔧 Development

### Frontend Development
Start Vite development server for hot module replacement:
```bash
npm run dev
```

In a separate terminal, start Laravel server:
```bash
php artisan serve
```

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 📁 Project Structure

```
xcodera/
├── app/
│   ├── Http/Controllers/        # Application controllers
│   │   ├── DashboardController.php
│   │   ├── UserController.php
│   │   ├── AnalyticsController.php
│   │   └── ...
│   ├── Models/                  # Eloquent models
│   └── View/Components/         # Blade components classes
├── resources/
│   ├── views/
│   │   ├── components/          # Reusable UI components
│   │   │   ├── layout/          # Layout (navbar, sidebar, footer)
│   │   │   ├── ui/              # UI elements (button, card, modal)
│   │   │   ├── form/            # Form components (input, select)
│   │   │   ├── data/            # Data display (table, chart, stats)
│   │   │   ├── utils/           # Utilities (breadcrumbs, pagination)
│   │   │   └── premium/         # Premium features
│   │   └── pages/               # Page views
│   │       ├── dashboard/
│   │       ├── users/
│   │       ├── settings/
│   │       └── reports/
│   ├── css/                     # Stylesheets
│   ├── js/                      # JavaScript files
│   └── docs/                    # Component documentation
├── routes/
│   ├── web.php                  # Web routes
│   └── auth.php                 # Authentication routes
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
└── tests/
    ├── Feature/                 # Feature tests
    └── Unit/                    # Unit tests
```

---

## 📖 Documentation

### Component Documentation
Detailed documentation for all components is available in `resources/docs/components/`:

- [Button Component](resources/docs/components/button.md)
- [Input Component](resources/docs/components/input.md)
- [Modal Component](resources/docs/components/modal.md)
- [Table Component](resources/docs/components/table.md)
- [Avatar Component](resources/docs/components/avatar.md)

### Deployment Guide
For production deployment instructions, see [Deployment Guide](resources/docs/deployment.md)

---

## 🎨 Key Components

### UI Components
- **Buttons** - Multiple variants (primary, secondary, danger) with loading states
- **Cards** - Flexible card layouts with headers, body, and footer
- **Modals** - Accessible modals with backdrop and animations
- **Alerts** - Dismissible alerts with multiple severity levels
- **Badges** - Status indicators with color variants
- **Toast** - Auto-dismissing notification toasts

### Data Components
- **Tables** - Responsive tables with sorting and pagination
- **Charts** - Line, bar, pie charts with Chart.js
- **Stat Cards** - Dashboard statistics with trend indicators
- **Timeline** - Activity timeline component
- **Empty States** - User-friendly empty state designs

### Form Components
- **Input** - Text inputs with validation states
- **Select** - Styled select dropdowns
- **Textarea** - Auto-growing textarea fields
- **Switch** - Toggle switches for boolean values
- **Checkbox/Radio** - Custom styled checkboxes and radios
- **File Upload** - Drag-and-drop file uploader

---

## 🚦 Available Routes

| Route | Description | Auth Required |
|-------|-------------|---------------|
| `/` | Welcome page | No |
| `/login` | Login page | No |
| `/register` | Registration page | No |
| `/dashboard` | Main dashboard | Yes |
| `/users` | User management | Yes |
| `/settings` | Application settings | Yes |
| `/reports` | Reports page | Yes |
| `/analytics` | Analytics dashboard | Yes |

---

## 🧪 Testing

XCODERA includes comprehensive test suites:

### Feature Tests
- ✅ Authentication (Login, Register, Password Reset)
- ✅ Dashboard Access Control
- ✅ User Management CRUD
- ✅ Analytics Data

### Running Tests
```bash
# All tests
php artisan test

# Specific test
php artisan test --filter=UserManagementTest

# With coverage
php artisan test --coverage
```

---

## 🎯 Roadmap

- [x] Core dashboard functionality
- [x] User management system
- [x] Dark/Light mode
- [x] Chart integration
- [x] Command palette
- [ ] API integration
- [ ] Multi-language support (i18n)
- [ ] Advanced reporting
- [ ] Email notifications
- [ ] Two-factor authentication
- [ ] Activity logs
- [ ] Export to PDF/Excel

---

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. **Push** to the branch (`git push origin feature/AmazingFeature`)
5. **Open** a Pull Request

Please make sure to update tests as appropriate and follow the existing code style.

---

## 📝 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👏 Credits

### Built With
- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Alpine.js](https://alpinejs.dev) - Your new, lightweight, JavaScript framework
- [Chart.js](https://www.chartjs.org) - Simple yet flexible JavaScript charting
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze) - Laravel authentication scaffolding

### Developed By
**XcodeRA** - [GitHub](https://github.com/Codera0709)

---

## 📧 Support

If you have any questions or need help, please:

- Open an [Issue](https://github.com/Codera0709/xcodera/issues)
- Email: icodera.ai@gmail.com

---

<div align="center">

**⭐ If you find this project useful, please give it a star!**

Made with ❤️ by XcodeRA

</div>

# 🏡 Abad Raho Property Platform

[![Laravel](https://img.shields.io/badge/Laravel-8.x-red?logo=laravel)](https://laravel.com/) [![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue?logo=php)](https://www.php.net/) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

---

## 🌟 Overview

**Abad Raho** is your go-to property finder platform, founded in 2020, with the aim to provide exceptional residential and commercial projects to clients that satisfy market requirements and preferences. We strive to be Pakistan's leading property platform where you can search for your desired properties, compare projects, and invest in top-notch and renowned projects all over Pakistan.

---

## 🚀 Features

- 🔍 **Advanced Property Search**: Find properties by area, type, price, and more.
- 🏢 **Project Listings**: Explore detailed listings for residential and commercial projects.
- 📊 **Project Comparison**: Compare multiple projects side-by-side.
- 🏗️ **Builder & Broker Management**: Administer builders, brokers, and their projects.
- 📝 **Blog & News**: Stay updated with the latest real estate news and tips.
- 📈 **Analytics & Activity Logs**: Track user and admin activities.
- 🛡️ **User Authentication & Roles**: Secure login, registration, and role-based access.
- 📤 **Export & Reporting**: Export data to Excel and generate reports.
- 📱 **Mobile Responsive**: Fully responsive design for all devices.
- 🧩 **Extensible**: Built on Laravel 8.x, easy to extend and customize.

---

## 🎯 Mission, Vision & Values

> **Our Mission:**
> Serve clients with exceptional residential and commercial signature projects that meet market needs with high competencies and an integrated team.

> **Our Vision:**
> To be the leading Real Estate agency in Pakistan, expanding our growth beyond every possible reach, and developing relationships with our clients based on transparency and trust.

> **Our Core Values:**
> Communication, commitment, and client care are the core values that emanate throughout every strategy and activity we undertake. Our team delivers comprehensive, holistic Real Estate advice.

---

## 👤 User Roles & Authentication

- **Super Admin**: Full access to all features and settings.
- **Admin**: Manage projects, users, and content.
- **Builder**: Manage their own projects and listings.
- **Broker/Agent**: Manage property listings and client inquiries.
- **Buyer/User**: Search, compare, and inquire about properties.

Authentication is handled via Laravel's built-in system, with registration supporting multiple user types. Email verification and phone OTP are supported for enhanced security.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 8.x, PHP 7.4+
- **Frontend**: Blade, Bootstrap, Vue.js (for components)
- **Database**: MySQL
- **Other**: Composer, NPM, Laravel Mix, Spatie Activity Log, Laravel Vouchers, Excel Export, Socialite, and more

---

## ⚡ Quick Start

### 1. Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM (v16.x recommended)
- MySQL
- XAMPP (optional, for local dev)

### 2. Installation
```bash
# Clone the repo
git clone <your-repo-url>
cd <project-directory>

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy .env and set up your environment
cp .env.example .env
php artisan key:generate

# Set up your database in .env
# Option A: Import your SQL file (recommended if you have data)
# Option B: Run migrations for a fresh DB
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Compile frontend assets
npm run dev    # For development
npm run prod   # For production

# Serve the application
php artisan serve
# Or use XAMPP/Apache and point web root to public/
```

### 3. Running Tests
```bash
php artisan test
# or
vendor/bin/phpunit
```

---

## 🧩 Main Packages Used
- [Laravel Framework](https://laravel.com/)
- [Spatie Activity Log](https://spatie.be/docs/laravel-activitylog)
- [Laravel Vouchers](https://github.com/beyondcode/laravel-vouchers)
- [Laravel Socialite](https://laravel.com/docs/8.x/socialite)
- [Maatwebsite Excel](https://docs.laravel-excel.com/3.1/)
- [Barryvdh DomPDF](https://github.com/barryvdh/laravel-dompdf)
- [Biscolab ReCaptcha](https://github.com/biscolab/laravel-recaptcha)

---

## 📄 License

This project is open-sourced under the [MIT license](LICENSE).

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## 📬 Contact

For support or business inquiries, please contact the project maintainer or open an issue.
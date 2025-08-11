# Project Run Guide (Updated)

This guide explains how to set up, run, and troubleshoot your Laravel project for local development.

---

## 1. Prerequisites

- **PHP**: Version 8.1 or higher (8.2+ recommended)
- **Composer**: Dependency manager for PHP ([getcomposer.org](https://getcomposer.org/))
- **Node.js & NPM**: Node.js v16.x LTS is recommended for Laravel Mix 6 (see below for Node 17+ fix)
- **MySQL**: Or compatible database (phpMyAdmin for XAMPP)
- **XAMPP**: For local PHP/MySQL environment (optional but recommended)

---

## 2. Clone the Repository

```
git clone <your-repo-url>
cd <project-directory>
```

---

## 3. Install PHP Dependencies

```
composer install
```

If you see errors about missing PHP extensions (e.g., `ext-gd`, `ext-zip`), open `php.ini` in your XAMPP PHP folder and enable them by removing the `;` from lines like `;extension=gd` and `;extension=zip`, then restart Apache.

---

## 4. Install Node.js Dependencies

```
npm install
```

If you see errors about `npm.ps1 cannot be loaded`, run this in PowerShell as Administrator:
```
Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
```

---

## 5. Set Up Your .env File

1. Copy your old `.env` or use this template:

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
LOG_CHANNEL=stack
LOG_LEVEL=debug
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=markdev
DB_USERNAME=root
DB_PASSWORD=
BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="Laravel Local"
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_URL=
AWS_ENDPOINT=
QUEUE_FAILED_DRIVER=database-uuids
```

2. Generate the application key:
```
php artisan key:generate
```

---

## 6. Database Setup

### **Option A: Use Your Existing SQL File (Recommended if you have data/schema to import)**

1. Create a new database in phpMyAdmin (e.g., `markdev`).
2. Import your `.sql` file (e.g., `markprop_dev_abadraho.sql`) into this database.
3. Update your `.env` to use this database:
   - `DB_DATABASE=markdev`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=` (empty for XAMPP)
4. **Do NOT run migrations** if your SQL file already contains all tables.

### **Option B: Use Laravel Migrations (For a fresh/empty database)**

1. Create a new database in phpMyAdmin (e.g., `markdev`).
2. Update your `.env` to use this database.
3. Run:
   ```
   php artisan migrate
   ```
   or, to reset everything:
   ```
   php artisan migrate:fresh
   ```
4. If you want to seed with test data:
   ```
   php artisan db:seed
   ```

**If you get 'Multiple primary key defined' errors:**
- Edit the relevant migration file and comment out or remove any lines that add a primary key to a column that already has one.
- Example: In `add_autoincreament_in_id_in_users_table.php` and `add_auto_increaeament_in_builders.php`, leave the `up()` method empty.

---

## 7. Compile Frontend Assets

### **If using Node.js v17 or higher and you get an OpenSSL error:**
Run this in your terminal before `npm run dev`:
```
set NODE_OPTIONS=--openssl-legacy-provider
npm run dev
```
Or, in PowerShell:
```
$env:NODE_OPTIONS="--openssl-legacy-provider"
npm run dev
```

### **Recommended: Use Node.js v16 for best compatibility**
- Use [nvm-windows](https://github.com/coreybutler/nvm-windows) to install and switch to Node.js v16.

### **Compile assets:**
```
npm run dev    # For development
npm run prod   # For production
```

---

## 8. Serve the Application

```
php artisan serve
```
Visit [http://localhost:8000](http://localhost:8000) in your browser.

Or, if using XAMPP/Apache, point your web root to the `public/` directory and visit [http://localhost/markdev/public](http://localhost/markdev/public).

---

## 9. Running Tests

```
php artisan test
# or
vendor\bin\phpunit
```

---

## 10. Troubleshooting & Common Issues

- **Permission denied (Composer):** Run your terminal as Administrator and ensure your user has write access to the project folder.
- **Missing PHP extensions:** Edit `php.ini` and enable the required extensions, then restart Apache.
- **Multiple primary key errors:** Edit the migration file and remove the duplicate primary key code.
- **NPM script errors:** Use the Node.js v16 LTS or set the `NODE_OPTIONS` variable as above.
- **Mail not sending:** For local, use [MailHog](https://github.com/mailhog/MailHog) or [Mailtrap](https://mailtrap.io/).
- **Blank page or error:** Check `storage/logs/laravel.log` for details.

---

## 11. Useful Commands (Summary)

- Install PHP dependencies:
  ```
  composer install
  ```
- Install Node.js dependencies:
  ```
  npm install
  ```
- Generate app key:
  ```
  php artisan key:generate
  ```
- Run migrations:
  ```
  php artisan migrate
  ```
- Reset and re-run all migrations:
  ```
  php artisan migrate:fresh
  ```
- Seed the database:
  ```
  php artisan db:seed
  ```
- Compile assets:
  ```
  $env:NODE_OPTIONS="--openssl-legacy-provider"; npm run dev
  npm run dev
  npm run prod
  ```
- Serve the app:
  ```
  php artisan serve
  ```
- Run tests:
  ```
  php artisan test
  ```

---

For further help, consult the [Laravel documentation](https://laravel.com/docs/8.x) or your project maintainer.
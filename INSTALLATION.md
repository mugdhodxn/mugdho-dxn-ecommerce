# Mugdho DXN E-commerce Installation Guide

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM (optional, for asset compilation)

## Installation Steps

### 1. Install Dependencies

```bash
composer install
```

### 2. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file and configure:

```env
APP_NAME="Mugdho DXN"
APP_URL=http://localhost:8000

DB_DATABASE=mugdho_dxn
DB_USERNAME=root
DB_PASSWORD=your_password

# Payment Gateway Credentials
BKASH_APP_KEY=your_bkash_app_key
BKASH_APP_SECRET=your_bkash_app_secret
BKASH_USERNAME=your_bkash_username
BKASH_PASSWORD=your_bkash_password

NAGAD_MERCHANT_ID=your_nagad_merchant_id
NAGAD_MERCHANT_NUMBER=your_nagad_merchant_number
NAGAD_PUBLIC_KEY=your_nagad_public_key
NAGAD_PRIVATE_KEY=your_nagad_private_key

SSLCOMMERZ_STORE_ID=your_store_id
SSLCOMMERZ_STORE_PASSWORD=your_store_password
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Create Database

Create a MySQL database named `mugdho_dxn`

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will create all tables and seed with:
- Admin user (admin@mugdhodxn.com / admin123)
- Test customer (customer@test.com / password)
- 5 product categories
- 15 DXN products with real data

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Set Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit: http://localhost:8000

## Default Login Credentials

### Admin Panel
- URL: http://localhost:8000/admin
- Email: admin@mugdhodxn.com
- Password: admin123

### Customer Account
- Email: customer@test.com
- Password: password

## Payment Gateway Setup

### bKash
1. Register at https://www.bka.sh/merchant
2. Get sandbox/production credentials
3. Update `.env` with credentials
4. Set `BKASH_SANDBOX=true` for testing

### Nagad
1. Register at https://nagad.com.bd/merchant
2. Get API credentials and keys
3. Update `.env` with credentials
4. Set `NAGAD_SANDBOX=true` for testing

### SSLCOMMERZ (Bank Cards)
1. Register at https://sslcommerz.com
2. Get Store ID and Password
3. Update `.env` with credentials
4. Set `SSLCOMMERZ_SANDBOX=true` for testing

## Product Images

Product images should be placed in `storage/app/public/products/` directory.
The seeder expects images with SKU names (e.g., DXN-RG-90.jpg).

For testing, placeholder images will be shown automatically.

## Troubleshooting

### Storage Link Error
If storage link fails, manually create symlink:
```bash
ln -s ../storage/app/public public/storage
```

### Permission Issues
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
```

### Database Connection Error
- Check MySQL is running
- Verify database credentials in `.env`
- Ensure database exists

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Set `BKASH_SANDBOX=false`, `NAGAD_SANDBOX=false`, `SSLCOMMERZ_SANDBOX=false`
3. Use production payment gateway credentials
4. Configure proper web server (Apache/Nginx)
5. Enable HTTPS/SSL certificate
6. Set up proper backup system
7. Configure email settings for order notifications

## Support

For issues or questions, contact: info@mugdhodxn.com

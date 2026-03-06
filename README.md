# Mugdho DXN E-commerce Website

একটি সম্পূর্ণ Laravel-based ই-কমার্স ওয়েবসাইট DXN পণ্য বিক্রয়ের জন্য বাংলাদেশে।

## Features

- ✅ 50+ Real DXN Products with authentic Bangladesh pricing
- ✅ Shopping Cart System
- ✅ User Authentication (Register/Login)
- ✅ Admin Panel for Product & Order Management
- ✅ Payment Gateways: bKash, Nagad, SSLCOMMERZ (Bank Cards)
- ✅ Order Management System
- ✅ Responsive Design
- ✅ Product Categories
- ✅ Product Search & Filter

## Tech Stack

- Laravel 10
- PHP 8.2
- MySQL Database
- Bootstrap 5
- Blade Templates

## Installation

### Local Setup

1. Clone the repository
```bash
git clone https://github.com/YOUR-USERNAME/mugdho-dxn-ecommerce.git
cd mugdho-dxn-ecommerce
```

2. Install dependencies
```bash
composer install
```

3. Create .env file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Configure database in .env file
```env
DB_DATABASE=mugdho_dxn
DB_USERNAME=root
DB_PASSWORD=your_password
```

6. Run migrations and seeders
```bash
php artisan migrate --seed
```

7. Create storage link
```bash
php artisan storage:link
```

8. Start development server
```bash
php artisan serve
```

Visit: http://localhost:8000

### Default Admin Login

- Email: admin@mugdhodxn.com
- Password: admin123

## Railway.app Deployment

See [RAILWAY_DEPLOYMENT.md](RAILWAY_DEPLOYMENT.md) for complete deployment guide.

## Payment Gateway Setup

See [PAYMENT_SETUP.md](PAYMENT_SETUP.md) for payment gateway configuration.

## Product List

See [PRODUCT_LIST.md](PRODUCT_LIST.md) for complete DXN product list.

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── PaymentController.php
│   │   └── ProductController.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   └── User.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CategorySeeder.php
│       ├── ProductSeeder.php
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── layouts/
│   ├── products/
│   ├── cart/
│   ├── checkout/
│   └── orders/
└── routes/
    └── web.php
```

## Database Schema

### Users Table
- id, name, email, password, is_admin, timestamps

### Categories Table
- id, name, slug, description, timestamps

### Products Table
- id, category_id, name, slug, sku, description, price, stock, image, timestamps

### Orders Table
- id, user_id, order_number, total_amount, payment_method, payment_status, status, timestamps

### Order Items Table
- id, order_id, product_id, quantity, price, timestamps

## Payment Methods

### bKash
- Mobile wallet payment
- Sandbox & Production modes

### Nagad
- Mobile wallet payment
- Sandbox & Production modes

### SSLCOMMERZ
- Bank card payments (Visa, MasterCard, etc.)
- Sandbox & Production modes

## Admin Panel

Access: `/admin`

Features:
- Dashboard with statistics
- Product Management (Add/Edit/Delete)
- Category Management
- Order Management
- Order Status Updates

## Contributing

This is a private project for Mugdho DXN.

## License

Proprietary - All rights reserved

## Support

For support, email: support@mugdhodxn.com

## Credits

- DXN Bangladesh Official Product List
- Laravel Framework
- Bootstrap 5

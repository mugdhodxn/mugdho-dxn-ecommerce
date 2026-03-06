# Mugdho DXN E-commerce Website

A complete e-commerce platform for selling DXN products in Bangladesh with integrated payment gateways.

## Features

- Complete product catalog with DXN products
- User authentication and registration
- Shopping cart functionality
- Order management system
- Admin panel for product and order management
- Payment integration: bKash, Nagad, and Bank Cards (SSLCOMMERZ)
- Responsive design
- Product search and filtering
- Order tracking

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `php artisan storage:link`
7. Start the server: `php artisan serve`

## Default Admin Credentials

- Email: admin@mugdhodxn.com
- Password: admin123

## Payment Gateway Setup

### bKash
1. Register for bKash merchant account
2. Get API credentials from bKash
3. Update `.env` file with credentials

### Nagad
1. Register for Nagad merchant account
2. Get API credentials from Nagad
3. Update `.env` file with credentials

### SSLCOMMERZ (Bank Cards)
1. Register at SSLCOMMERZ
2. Get Store ID and Password
3. Update `.env` file with credentials

## License

MIT License

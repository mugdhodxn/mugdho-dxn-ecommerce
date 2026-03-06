# Railway.app এ Deploy করার সম্পূর্ণ গাইড

## কেন Railway.app?
- ✅ সম্পূর্ণ FREE
- ✅ Laravel support
- ✅ MySQL database included
- ✅ Automatic deployment from GitHub
- ✅ SSL certificate free
- ✅ Custom domain support

## ধাপ ১: GitHub এ Code Upload

### 1.1 Git Initialize করুন
```bash
git init
git add .
git commit -m "Initial commit - Mugdho DXN Ecommerce"
```

### 1.2 GitHub Repository তৈরি করুন
1. https://github.com এ যান
2. "New repository" ক্লিক করুন
3. Repository name: `mugdho-dxn-ecommerce`
4. Private/Public select করুন
5. "Create repository" ক্লিক করুন

### 1.3 Code Push করুন
```bash
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/mugdho-dxn-ecommerce.git
git push -u origin main
```

## ধাপ ২: Railway.app এ Account তৈরি

1. https://railway.app এ যান
2. "Login with GitHub" ক্লিক করুন
3. GitHub দিয়ে authorize করুন

## ধাপ ৩: New Project তৈরি

1. Dashboard এ "New Project" ক্লিক করুন
2. "Deploy from GitHub repo" select করুন
3. আপনার `mugdho-dxn-ecommerce` repository select করুন
4. Railway automatically detect করবে এটি Laravel project

## ধাপ ৪: MySQL Database Add করুন

1. Project dashboard এ "New" ক্লিক করুন
2. "Database" → "Add MySQL" select করুন
3. MySQL database automatically create হবে

## ধাপ ৫: Environment Variables Configure করুন

### 5.1 Laravel Service এ যান
1. আপনার Laravel service ক্লিক করুন
2. "Variables" tab এ যান

### 5.2 এই Variables Add করুন

```env
APP_NAME="Mugdho DXN"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_URL=https://your-app.up.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

# Database - Railway automatically provides these
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Mail (Configure later)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@mugdhodxn.com"
MAIL_FROM_NAME="${APP_NAME}"

# Payment Gateways (Add when ready)
BKASH_SANDBOX=true
BKASH_APP_KEY=
BKASH_APP_SECRET=
BKASH_USERNAME=
BKASH_PASSWORD=
BKASH_CALLBACK_URL="${APP_URL}/payment/bkash/callback"

NAGAD_SANDBOX=true
NAGAD_MERCHANT_ID=
NAGAD_MERCHANT_NUMBER=
NAGAD_PUBLIC_KEY=
NAGAD_PRIVATE_KEY=
NAGAD_CALLBACK_URL="${APP_URL}/payment/nagad/callback"

SSLCOMMERZ_SANDBOX=true
SSLCOMMERZ_STORE_ID=
SSLCOMMERZ_STORE_PASSWORD=
```

### 5.3 APP_KEY Generate করুন

Local এ run করুন:
```bash
php artisan key:generate --show
```

Output copy করে Railway এর `APP_KEY` variable এ paste করুন।

## ধাপ ৬: Build & Deploy Settings

### 6.1 Settings Tab এ যান
1. "Build Command" set করুন:
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

2. "Start Command" set করুন:
```bash
php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
```

## ধাপ ৭: Database Migration Run করুন

### Option 1: Railway CLI দিয়ে
```bash
# Railway CLI install করুন
npm i -g @railway/cli

# Login করুন
railway login

# Project link করুন
railway link

# Migration run করুন
railway run php artisan migrate --seed
```

### Option 2: Manual SQL Import
1. Railway dashboard এ MySQL service ক্লিক করুন
2. "Connect" tab থেকে credentials নিন
3. Local থেকে database export করুন
4. Railway MySQL এ import করুন

## ধাপ ৮: Storage Link তৈরি

Railway console এ:
```bash
php artisan storage:link
```

## ধাপ ৯: Admin User তৈরি

যদি seeder run না করে থাকেন:
```bash
railway run php artisan db:seed --class=DatabaseSeeder
```

## ধাপ ১০: Custom Domain Setup (Optional)

### Free Subdomain
Railway automatically দেয়: `your-app.up.railway.app`

### Custom Domain
1. Settings → "Domains" এ যান
2. "Custom Domain" add করুন
3. আপনার domain provider এ CNAME record add করুন:
   - Type: CNAME
   - Name: www (or @)
   - Value: your-app.up.railway.app

## ধাপ ১১: SSL Certificate

Railway automatically SSL certificate provide করে। কিছু করতে হবে না।

## ধাপ ১২: File Upload Storage

Railway এ file storage persistent না। তাই:

### Option 1: AWS S3 ব্যবহার করুন
```bash
composer require league/flysystem-aws-s3-v3
```

### Option 2: Cloudinary ব্যবহার করুন
```bash
composer require cloudinary-labs/cloudinary-laravel
```

## Troubleshooting

### Error: "No application encryption key"
```bash
railway run php artisan key:generate
```

### Error: "Storage link not found"
```bash
railway run php artisan storage:link
```

### Database connection error
- MySQL service running আছে কিনা check করুন
- Environment variables ঠিক আছে কিনা verify করুন

### 500 Internal Server Error
```bash
# Logs দেখুন
railway logs

# Cache clear করুন
railway run php artisan cache:clear
railway run php artisan config:clear
railway run php artisan route:clear
railway run php artisan view:clear
```

## Deployment Checklist

- [ ] GitHub এ code push করেছেন
- [ ] Railway project তৈরি করেছেন
- [ ] MySQL database add করেছেন
- [ ] Environment variables set করেছেন
- [ ] APP_KEY generate করেছেন
- [ ] Database migration run করেছেন
- [ ] Storage link তৈরি করেছেন
- [ ] Admin login test করেছেন
- [ ] Payment gateway credentials add করেছেন (production এ)

## Production এ যাওয়ার আগে

1. `APP_DEBUG=false` set করুন
2. `APP_ENV=production` set করুন
3. Payment gateway sandbox mode off করুন
4. SSL certificate verify করুন
5. Backup system setup করুন

## Support

- Railway Docs: https://docs.railway.app
- Laravel Docs: https://laravel.com/docs
- Community: Railway Discord

## Cost

Railway Free Tier:
- $5 credit/month
- Enough for small to medium traffic
- Upgrade করতে পারবেন যখন প্রয়োজন

## Next Steps

1. Logo এবং product images upload করুন
2. Payment gateway setup করুন
3. Email configuration করুন
4. Google Analytics add করুন
5. SEO optimization করুন

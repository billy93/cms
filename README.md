<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 🚀 Quick Start - CMS Bootstrap Admin Laravel

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- Database (MySQL/PostgreSQL/SQLite)

### Installation & Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   # Copy environment file
   copy .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Configure database**
   - Edit `.env` file and set your database credentials
   - Run migrations: `php artisan migrate`
   - Seed sample data: `php artisan db:seed --class=CustomerSeeder` and `php artisan db:seed --class=SupplierSeeder`

5. **Build assets**
   ```bash
   npm run build
   ```

### 🎯 Running the Application

**Easiest way (Recommended):**
```bash
composer run dev
```

This command will start:
- Laravel development server
- Queue listener
- Vite development server (for assets)

**Alternative methods:**
```bash
# Only Laravel server
php artisan serve
php -S localhost:8000 -t public
# Only build assets
npm run dev
```

### 📊 Sample Data
The application comes with sample data for testing:
- **8 Sample Customers** - Various customer types with bank information
- **8 Sample Suppliers** - Different supplier categories with tax and bank info
- **Multiple PICs** - Sample contact persons for customers and suppliers

### 🌐 Access URLs
- **Homepage**: `http://localhost:8000/`
- **Dashboard**: `http://localhost:8000/dashboard`
- **Login**: `http://localhost:8000/register`
- **Customers**: `http://localhost:8000/customers`
- **Suppliers**: `http://localhost:8000/suppliers`

### 📁 Project Structure
This is a **CMS Bootstrap Admin Laravel** application with features:
- Dashboard & Analytics
- CRM System (Leads, Deals, Contacts, Companies)
- **Master Data Management (Customer & Supplier)**
- Project Management
- Invoice & Billing
- User Management
- UI Components (Bootstrap-based admin template)
- File Management
- Email & Communication

### 🎯 Master Data Management Features

#### **Customer Management**
- **Customer List** - View all customers with search and filter
- **Customer Detail** - Detailed customer information with tabs
- **Bank Information** - Bank name, account number, account holder
- **Multiple PIC Support** - Add multiple Person In Charge per customer
- **PIC Management** - CRUD operations for customer contacts
- **Status Management** - Active/Inactive customer status

#### **Supplier Management**
- **Supplier List** - View all suppliers with search and filter
- **Supplier Detail** - Detailed supplier information with tabs
- **Bank Information** - Bank name, account number, account holder
- **Tax Information** - NPWP number for suppliers
- **Multiple PIC Support** - Add multiple Person In Charge per supplier
- **PIC Management** - CRUD operations for supplier contacts
- **Status Management** - Active/Inactive supplier status

#### **PIC (Person In Charge) Features**
- **Name & Position** - Contact person details
- **Contact Information** - Email and phone number
- **Status Management** - Active/Inactive PIC status
- **Notes** - Additional information for each PIC
- **Multiple PICs** - Support for multiple contacts per customer/supplier

### 🔧 Technical Implementation

#### **Database Structure**
- **customers** table - Main customer data with bank info
- **suppliers** table - Main supplier data with bank and tax info
- **customer_pics** table - Multiple PICs for customers
- **supplier_pics** table - Multiple PICs for suppliers

#### **API Endpoints**
- **Customer APIs**: `/api/customers/*`
- **Customer PIC APIs**: `/api/customers/{id}/pics/*`
- **Supplier APIs**: `/api/suppliers/*`
- **Supplier PIC APIs**: `/api/suppliers/{id}/pics/*`

#### **Frontend Features**
- **Responsive Design** - Mobile-friendly interface
- **Tab Navigation** - Switch between info and PIC management
- **Modal Forms** - Add/Edit forms with validation
- **Search & Filter** - Advanced search and status filtering
- **Pagination** - Efficient data loading
- **Export Options** - PDF and Excel export capabilities

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

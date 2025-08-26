# HomeFinder Uganda 🏠

A comprehensive rental property management platform built for Uganda, connecting landlords and tenants with powerful administrative tools.

## 🌟 Features

### For Tenants
- **Property Search**: Browse available properties with advanced filtering
- **Location-based Search**: Find properties in specific Ugandan cities
- **Price Range Filtering**: Search within your budget
- **Property Details**: View detailed information, images, and contact landlords

### For Landlords
- **Property Management**: Add, edit, and manage your property listings
- **Dashboard**: Track your properties and their status
- **Image Upload**: Showcase properties with high-quality images
- **Status Tracking**: Monitor approval status of your listings

### For Administrators
- **User Management**: Manage all platform users and their roles
- **Property Approval**: Review and approve/reject property listings
- **Analytics Dashboard**: Platform statistics and insights
- **Content Moderation**: Ensure quality and appropriate content

## 🚀 Technology Stack

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: SQLite (easily configurable to MySQL/PostgreSQL)
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage with public disk
- **Styling**: Tailwind CSS with custom components

## 📱 User Roles

1. **Tenant**: Can search and view properties
2. **Landlord**: Can list and manage properties
3. **Admin**: Full platform management capabilities

## 🛠️ Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- Git

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/homefinder00/homefinderug_blade.git
   cd homefinderug_blade
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage setup**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see the application.

## 🏗️ Project Structure

```
app/
├── Http/Controllers/
│   ├── AdminController.php          # Admin panel functionality
│   ├── PropertyController.php       # Property CRUD operations
│   └── Auth/                       # Authentication controllers
├── Models/
│   ├── User.php                    # User model with roles
│   └── Property.php                # Property model
└── Requests/                       # Form request validation

resources/views/
├── admin/                          # Admin panel views
├── properties/                     # Property management views
├── auth/                          # Authentication views
└── layouts/                       # Layout templates

database/
├── migrations/                     # Database migrations
├── seeders/                       # Data seeders
└── database.sqlite                # SQLite database file
```

## 🎨 Key Features Implementation

### Property Management
- Image upload and storage
- Status workflow (pending → approved/rejected)
- Search and filtering capabilities
- Responsive grid layout

### User Authentication
- Role-based access control
- Registration with role selection
- Profile management
- Secure authentication flow

### Admin Panel
- User management with role changes
- Property approval workflow
- Platform analytics
- Comprehensive dashboard

## 🔧 Configuration

### Database
The application uses SQLite by default. To use MySQL or PostgreSQL:

1. Update `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=homefinder
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

2. Run migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

### File Storage
Images are stored in `storage/app/public/properties/`. The storage is linked to `public/storage/`.

## 🌍 Uganda-Specific Features

- **Local Currency**: Prices displayed in Ugandan Shillings (UGX)
- **Ugandan Locations**: Pre-configured with major Ugandan cities and areas
- **Local Context**: UI and content tailored for the Ugandan market

## 👥 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🤝 Support

For support and questions:
- Open an issue on GitHub
- Contact: [Your contact information]

## 🎯 Roadmap

- [ ] Mobile app development
- [ ] Payment integration (Mobile Money)
- [ ] Map integration
- [ ] Advanced property analytics
- [ ] Tenant-Landlord messaging system
- [ ] Property maintenance tracking

---

**Built with ❤️ for Uganda's rental market**

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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

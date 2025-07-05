# DroneHub - Premium Drone Store & Racing Academy

A modern e-commerce platform for drone sales and racing course bookings, built with Laravel, Docker, and SQLite. Features a comprehensive admin panel for managing products, courses, and bookings. Inspired by DJI's sleek design aesthetic.

## 🚁 Features

### E-commerce Platform
- **Product Catalog**: Browse premium drones with detailed specifications
- **Shopping Cart**: Add products and manage orders
- **Secure Payments**: Integrated payment processing
- **Order Management**: Track orders and manage inventory
- **Featured Products**: Highlight special products on the homepage

### Racing Academy
- **Course Booking**: Schedule drone racing lessons for primary school students
- **Instructor Management**: Professional instructors for all skill levels
- **Certificate System**: Award completion certificates
- **Student Progress**: Track learning progress

### Admin Panel
- **Product Management**: Add, edit, and delete products with images
- **Course Management**: Create and manage racing courses
- **Booking Management**: View and manage all course bookings
- **User Management**: Admin user authentication and authorization
- **Category Management**: Organize products by categories

### Modern UI/UX
- **DJI-Inspired Design**: Clean, minimalist interface
- **Dark Theme**: Premium dark theme with blue/purple accents
- **Responsive**: Mobile-first responsive design
- **Interactive**: Smooth animations and hover effects

## 🛠 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Database**: SQLite (development) / PostgreSQL (production)
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Authentication**: Laravel Breeze with Admin Middleware
- **Containerization**: Docker & Docker Compose
- **Web Server**: Nginx
- **Caching**: Redis (optional)

## 🚀 Quick Start

### Prerequisites
- Docker and Docker Compose
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd DroneWebsite
   ```

2. **Start the application**
   ```bash
   docker-compose up -d
   ```

3. **Install dependencies and setup**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan migrate
   docker-compose exec app npm run build
   ```

4. **Seed the database with sample data**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

5. **Access the application**
   - Website: http://localhost:8081

### Development Setup

1. **Generate application key**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

2. **Run migrations**
   ```bash
   docker-compose exec app php artisan migrate
   ```

3. **Seed database with sample data**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

4. **Create admin user (if not seeded)**
   ```bash
   docker-compose exec app php artisan make:seeder AdminSeeder
   ```

## 📁 Project Structure

```
DroneWebsite/
├── app/
│   ├── Models/          # Eloquent models (User, Product, Course, Booking, Category)
│   ├── Http/
│   │   ├── Controllers/ # Controllers including Admin controllers
│   │   ├── Middleware/  # Admin middleware for authentication
│   │   └── Requests/    # Form request validation
│   └── ...
├── database/
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders (Admin, Product, Course, Category)
├── resources/
│   ├── views/           # Blade templates
│   │   ├── admin/       # Admin panel views
│   │   ├── products/    # Product views
│   │   ├── courses/     # Course views
│   │   └── bookings/    # Booking views
│   ├── css/             # Stylesheets
│   └── js/              # JavaScript
├── docker/              # Docker configuration
├── docker-compose.yml   # Docker services
└── README.md
```

## 🗄 Database Schema

### Core Tables
- **users**: Customer and admin accounts with role-based access
- **products**: Drone inventory with specifications and featured status
- **categories**: Product categorization
- **courses**: Racing course information
- **bookings**: Course reservations and payments

### Key Relationships
- Products belong to Categories
- Bookings belong to Users and Courses
- Users have role-based permissions (admin/customer)

## 🎨 Design System

### Colors
- **Primary**: Blue (#3B82F6)
- **Secondary**: Purple (#8B5CF6)
- **Success**: Green (#10B981)
- **Background**: Black (#000000)
- **Surface**: Gray-800 (#1F2937)

### Typography
- **Font**: Figtree (Google Fonts)
- **Headings**: Bold, large sizes with gradients
- **Body**: Regular weight, good contrast

## 🔧 Configuration

### Environment Variables
Key environment variables in `.env`:
- `DB_*`: Database configuration
- `REDIS_*`: Redis configuration (optional)
- `APP_*`: Application settings

### Docker Services
- **app**: Laravel application (PHP-FPM)
- **webserver**: Nginx web server
- **db**: SQLite database (development)
- **redis**: Redis cache (optional)

## 📝 API Documentation

### Product Endpoints
- `GET /products` - List all products
- `GET /products/{id}` - Get product details
- `GET /admin/products` - Admin product management
- `POST /admin/products` - Create product (admin)
- `PUT /admin/products/{id}` - Update product (admin)
- `DELETE /admin/products/{id}` - Delete product (admin)

### Course Endpoints
- `GET /courses` - List available courses
- `GET /admin/courses` - Admin course management
- `POST /admin/courses` - Create course (admin)

### Booking Endpoints
- `GET /bookings/create` - Booking form
- `POST /bookings` - Create new booking
- `GET /admin/bookings` - Admin booking management

### Admin Endpoints
- `GET /admin` - Admin dashboard
- `GET /admin/login` - Admin login
- `POST /admin/login` - Admin authentication

## 🧪 Testing

Run the test suite:
```bash
docker-compose exec app php artisan test
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure proper database credentials (PostgreSQL recommended)
3. Set up SSL certificates
4. Configure domain and DNS
5. Set up admin user credentials

### Performance Optimization
- Enable Redis caching
- Optimize images
- Use CDN for static assets
- Enable gzip compression

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions:
- Create an issue on GitHub
- Email: support@dronehub.com

## 🎯 Roadmap

- [x] Admin panel with product management
- [x] Course booking system
- [x] User authentication and authorization
- [x] Featured products functionality
- [ ] Payment gateway integration (Stripe/PayPal)
- [ ] Real-time notifications
- [ ] Mobile app development
- [ ] Advanced course scheduling
- [ ] Drone simulator integration
- [ ] Multi-language support
- [ ] Email notifications for bookings
- [ ] Advanced admin analytics dashboard

---

Built with ❤️ for the next generation of drone pilots.

# DroneHub - Premium Drone Store & Racing Academy

A modern e-commerce platform for drone sales and racing course bookings, built with Laravel, Docker, and PostgreSQL. Inspired by DJI's sleek design aesthetic.

## 🚁 Features

### E-commerce Platform
- **Product Catalog**: Browse premium drones with detailed specifications
- **Shopping Cart**: Add products and manage orders
- **Secure Payments**: Integrated payment processing
- **Order Management**: Track orders and manage inventory

### Racing Academy
- **Course Booking**: Schedule drone racing lessons for primary school students
- **Instructor Management**: Professional instructors for all skill levels
- **Certificate System**: Award completion certificates
- **Student Progress**: Track learning progress

### Modern UI/UX
- **DJI-Inspired Design**: Clean, minimalist interface
- **Dark Theme**: Premium dark theme with blue/purple accents
- **Responsive**: Mobile-first responsive design
- **Interactive**: Smooth animations and hover effects

## 🛠 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Database**: PostgreSQL 15
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Authentication**: Laravel Breeze
- **Containerization**: Docker & Docker Compose
- **Web Server**: Nginx
- **Caching**: Redis

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

4. **Access the application**
   - Website: http://localhost:8080
   - Database: localhost:5432

### Development Setup

1. **Generate application key**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

2. **Run migrations**
   ```bash
   docker-compose exec app php artisan migrate
   ```

3. **Seed database (optional)**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

## 📁 Project Structure

```
DroneWebsite/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/Controllers/# Controllers
│   └── ...
├── database/
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── resources/
│   ├── views/           # Blade templates
│   ├── css/             # Stylesheets
│   └── js/              # JavaScript
├── docker/              # Docker configuration
├── docker-compose.yml   # Docker services
└── README.md
```

## 🗄 Database Schema

### Core Tables
- **products**: Drone inventory with specifications
- **categories**: Product categorization
- **courses**: Racing course information
- **bookings**: Course reservations and payments
- **users**: Customer and admin accounts

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
- `REDIS_*`: Redis configuration
- `APP_*`: Application settings

### Docker Services
- **app**: Laravel application (PHP-FPM)
- **webserver**: Nginx web server
- **db**: PostgreSQL database
- **redis**: Redis cache

## 📝 API Documentation

### Product Endpoints
- `GET /api/products` - List all products
- `GET /api/products/{id}` - Get product details
- `POST /api/products` - Create product (admin)

### Booking Endpoints
- `GET /api/courses` - List available courses
- `POST /api/bookings` - Create new booking
- `GET /api/bookings/{id}` - Get booking details

## 🧪 Testing

Run the test suite:
```bash
docker-compose exec app php artisan test
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure proper database credentials
3. Set up SSL certificates
4. Configure domain and DNS

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

- [ ] Payment gateway integration (Stripe/PayPal)
- [ ] Real-time notifications
- [ ] Mobile app development
- [ ] Advanced course scheduling
- [ ] Drone simulator integration
- [ ] Multi-language support

---

Built with ❤️ for the next generation of drone pilots.

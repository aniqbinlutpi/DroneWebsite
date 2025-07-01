#!/bin/bash

echo "🚁 Starting DroneHub Application..."

# Start Docker containers
echo "📦 Starting Docker containers..."
docker-compose up -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 10

# Install dependencies if not already installed
if [ ! -d "vendor" ]; then
    echo "📦 Installing Composer dependencies..."
    docker-compose exec app composer install
fi

# Run migrations
echo "🗄️ Running database migrations..."
docker-compose exec app php artisan migrate --force

# Generate key if needed
echo "🔑 Ensuring application key is set..."
docker-compose exec app php artisan key:generate --force

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

echo "✅ DroneHub is ready!"
echo "🌐 Access your application at: http://localhost:8081"
echo "🗄️ Database is available at: localhost:5433"
echo ""
echo "📝 To stop the application, run: docker-compose down" 
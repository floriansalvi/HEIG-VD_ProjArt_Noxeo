#!/bin/bash
set -e

# --- Start Mailhog ---
echo "Checking Mailhog..."
if ! pgrep -f "Mailhog" > /dev/null; then
    echo "Starting Mailhog..."
    Mailhog > /dev/null 2>&1 &
else
    echo "Mailhog is already running"
fi

# --- Start MySQL (optional, macOS Homebrew example) ---
if [[ "$OSTYPE" == "darwin"* ]]; then
    echo "Checking MySQL..."
    if ! pgrep -x "mysqld" > /dev/null; then
        echo "Starting MySQL..."
        brew services start mysql
    else
        echo "MySQL is already running"
    fi
fi

# Install back-end dependencies
echo "Installing back-end dependencies..."
cd backend || exit
composer install

# Configure the .env file
echo "Configuring the .env file..."
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
echo "Running migrations and seeders..."
php artisan migrate
php artisan db:seed

# Start the back-end server
echo "Starting the back-end server..."
php artisan serve &

# Install front-end dependencies
echo "Installing front-end dependencies..."
cd ../frontend || exit
npm install

# Start the front-end server
echo "Starting the front-end server..."
npm run dev &

echo "✅ Setup complete. Front-end, back-end, Mailhog (http://localhost:8025) are running."
wait

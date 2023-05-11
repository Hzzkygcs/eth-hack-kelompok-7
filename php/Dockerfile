FROM php:8.0-apache





# Set the working directory to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
#COPY . /app

# Install SQLite and the PHP SQLite extension
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Start the PHP built-in web server on port 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/app"]

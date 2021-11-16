# Request-app

App runs on base address /records

# Requirements

- PHP 7.2+
- php-curl extension
- Apache2

or 

- Docker

# Instalation

## With docker

1. Copy .env.example file to .env with command `cp .env.example .env`
2. Set values in .env file
3. Run `docker build -t IMAGE_NAME .`
3. Run `docker run -d -p YOUR_PREFERED_PORT:80 IMAGE_NAME`

## Without docker 

1. Copy project files from /src to /var/www/html/
2. Enable apache2 mode_rewrite 
3. Copy .env.example file to .env with command `cp .env.example .env`
4. Set values in .env file

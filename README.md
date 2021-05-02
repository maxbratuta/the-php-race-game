# The PHP Race Game

Create a Race Game project using vanilla PHP.

## Installation Overview

**1. Install prerequisites.**
- nginx
- php-fpm 7.4
- composer

**2. Clone project.**

```sh
git clone https://github.com/maxbratuta/the-php-race-game.git
```

**3. Configure nginx.**
```sh
server {
    listen 80;
    listen [::]:80;

    server_name the-php-race-game;
    root /var/www/the-php-race-game;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php-fpm_7.4:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

**4. Run install script.**

Run next command to install external libraries.
```sh
composer install
```
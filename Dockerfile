FROM php:5.6-cli

EXPOSE 80

CMD php -S 0.0.0.0:80 -t /var/www/src /var/www/src/index.php

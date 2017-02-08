FROM php:5.6-cli

COPY src/ /var/www/html/

EXPOSE 80

CMD php -S 0.0.0.0:80 -t /var/www/html /var/www/html/index.php

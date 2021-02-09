FROM php:7.4-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install msmtp ca-certificates zlib1g-dev libpng-dev libjpeg-dev -y 
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-jpeg && docker-php-ext-install gd
RUN sed -i -e "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
RUN echo "LoadModule rewrite_module modules/mod_rewrite.so" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
COPY settings /etc/msmtprc
RUN chmod 600 /etc/msmtprc && chown www-data:www-data /etc/msmtprc
RUN touch /var/log/msmtp.log && chown www-data:www-data /var/log/msmtp.log
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN rm -rf /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini-production
RUN echo "sendmail_path = \"/usr/bin/msmtp -t\"" >> /usr/local/etc/php/php.ini
RUN service apache2 restart
EXPOSE 80 443

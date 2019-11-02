FROM ubuntu:18.04

RUN DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get upgrade -y

# see https://askubuntu.com/questions/909277/avoiding-user-interaction-with-tzdata-when-installing-certbot-in-a-docker-contai
RUN apt-get install -y tzdata

# CakePHP 3.x minimum dependencies and minimum requirements for apps with PHP / Composer
RUN apt-get install -y apache2 php7.2 php7.2-mbstring php7.2-intl php7.2-xml ca-certificates zip composer

# PHP extensions for this app
RUN apt-get install -y php7.2-mysql php7.2-json

# PHP extensions for local development
RUN apt-get install -y php7.2-sqlite3

# for debugging
RUN apt-get install -y vim less mysql-client ca-certificates


# composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY composer_install.sh /
RUN chmod 755 /composer_install.sh

# apache setting
COPY site.conf /etc/apache2/conf-enabled/
RUN cd /etc/apache2/mods-enabled; ln -s ../mods-available/rewrite.load ./

# document root
RUN rm -rf /var/www/html
RUN cd /var/www; ln -s /repository ./html


# the process
CMD ["apachectl", "-D", "FOREGROUND"]

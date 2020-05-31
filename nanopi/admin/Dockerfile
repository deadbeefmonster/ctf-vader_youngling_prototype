FROM raspbian/stretch
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get -y upgrade &&  apt-get install -y zlib1g-dev libapache2-mod-php net-tools bash sudo netcat php-mysql php-xml php-zip php-mbstring php-gd php-curl 
# Transfer certificates
# Transfer virtual host configuration
RUN a2enmod socache_shmcb
RUN a2enmod headers
RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
RUN mkdir -p /var/www/docroot
#ADD docroot /var/www/docroot
CMD rm /etc/apache2/sites-enabled/*
ADD admin_controller_empire.conf /etc/apache2/sites-enabled/admin_controller_empire.conf
CMD mkdir -p /etc/apache2/ssl
ADD controller.pem /etc/apache2/ssl/
EXPOSE 443
CMD /usr/sbin/apache2ctl -D FOREGROUND

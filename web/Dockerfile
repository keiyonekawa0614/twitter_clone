FROM centos:6

RUN yum -y update

RUN yum -y install git
RUN yum -y install zip unzip

RUN rpm -ivh http://dl.fedoraproject.org/pub/epel/6/i386/epel-release-6-8.noarch.rpm
RUN rpm -ivh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
RUN yum install -y httpd
RUN yum install --enablerepo=epel,remi-php70,remi -y \
                              php \
                              php-cli \
                              php-gd \
                              php-mbstring \
                              php-mcrypt \
                              php-mysqlnd \
                              php-pdo \
                              php-xml \
                              php-xdebug \
                              php-memcached \
                              php-devel
RUN sed -i -e "s|^;date.timezone =.*$|date.timezone = Asia/Tokyo|" /etc/php.ini

RUN curl -s https://getcomposer.org/installer | php
RUN mv ./composer.phar /usr/local/bin/composer

RUN cp /usr/share/zoneinfo/Japan /etc/localtime

COPY httpd.conf /etc/httpd/conf.d/httpd.conf

EXPOSE 80
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]
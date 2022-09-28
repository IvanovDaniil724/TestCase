FROM php:7.4.29-cli
RUN apt-get update
RUN docker-php-ext-install bcmath
RUN apt-get install libgmp10
#RUN docker-php-ext-install gmp
#RUN apt-get install gmp-dev
#RUN docker-php-ext-install libgmp3-dev
#RUN apt-get install libgmp3-dev
#RUN docker-php-ext-install libgmp10
#RUN apt install php-gmp
WORKDIR /usr/src/testcase
EXPOSE 3000
COPY . /usr/src/testcase
#COPY php.ini-development /usr/local/etc/php
#COPY php/php.ini /usr/local/etc/php
CMD [ "php", "./test/IvanovDaniilV2.php" ]
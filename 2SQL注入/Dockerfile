FROM ctfhub/web_nginx_mysql_php_7.4:latest

RUN rm -rf /var/www/html/*

RUN touch /flag && chmod 777 /flag

COPY src /var/www/html/
COPY files/flag.sh /flag.sh

COPY files/start.sh /var/www/html/start.sh


CMD ["/flag.sh"]
FROM mysql:8.0.33

COPY my.cnf /etc/mysql/my.cnf
COPY docker-entrypoint-initdb.d/createdb.sql /docker-entrypoint-initdb.d/createdb.sql

WORKDIR /var/lib/mysql

CMD ["mysqld"]

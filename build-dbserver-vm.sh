#!/bin/bash

apt-get update
export MYSQL_PWD='insecure_mysqlroot_pw'

echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

apt-get -y install mysql-server mysql-client

service mysql start

echo "DROP DATABASE IF EXISTS RecipeManagementSystem;" | mysql
echo "CREATE DATABASE RecipeManagementSystem;" | mysql

echo "DROP USER IF EXISTS 'admin'@'%';" | mysql
echo "CREATE USER 'admin'@'%' IDENTIFIED BY 'admin_pw';" | mysql

echo "GRANT ALL PRIVILEGES ON RecipeManagementSystem.* TO 'admin'@'%'" | mysql

echo "DROP USER IF EXISTS 'user'@'%';" | mysql
echo "CREATE USER 'user'@'%' IDENTIFIED BY 'user_pw';" | mysql

echo "GRANT SELECT, INSERT, UPDATE, DELETE ON RecipeManagementSystem.* TO 'user'@'%'" | mysql
echo FLUSH PRIVILEGES | mysql

export MYSQL_ADMIN_PWD='admin_pw'
export MYSQL_USER_PWD='user_pw'

cat /vagrant/setup-database.sql | mysql -u admin -p$MYSQL_ADMIN_PWD RecipeManagementSystem

sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

mysql -u root -p$MYSQL_PWD -e "SHOW VARIABLES LIKE 'secure_file_priv';"

service mysql restart

rm /var/lib/mysql-files/*
cp /vagrant/data/*.csv /var/lib/mysql-files/
ls /var/lib/mysql-files/ 

mysql -u root -p$MYSQL_PWD RecipeManagementSystem -e "LOAD DATA INFILE '/var/lib/mysql-files/ingredients.csv' INTO TABLE Ingredient FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 ROWS;"

cat /vagrant/insert-data.sql | mysql -u admin -p$MYSQL_ADMIN_PWD RecipeManagementSystem

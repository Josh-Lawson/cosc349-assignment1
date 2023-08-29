#!/bin/bash

apt-get update
export MYSQL_PWD='insecure_mysqlroot_pw'

echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

apt-get -y install mysql-server mysql-client

service mysql start

echo "CREATE DATABASE recipeManagementSystem;" | mysql
echo "CREATE USER 'admin'@'%' IDENTIFIED BY 'admin_pw';" | mysql
echo "GRANT ALL PRIVILEGES ON recipeManagementSystem.* TO 'admin'@'%'" | mysql
echo "CREATE USER 'user'@'%' IDENTIFIED BY 'user_pw';" | mysql
echo "GRANT SELECT, INSERT, UPDATE, DELETE ON recipeManagementSystem.* TO 'user'@'%'" | mysql
echo FLUSH PRIVILEGES | mysql

export MYSQL_ADMIN_PWD='admin_pw'
export MYSQL_USER_PWD='user_pw'

cat /vagrant/setup-database.sql | mysql -u admin -p$MYSQL_ADMIN_PWD recipeManagementSystem

sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

service mysql restart

apt-get update
apt-get install -y apache2 php libapache2-mod-php php-mysql
cp /vagrant/user-website.conf /etc/apache2/sites-available/
a2dissite 000-default
service apache2 restart
a2ensite user-website
service apache2 restart

# Configure apache virtual host
sudo nano /etc/apache2/sites-available/mixifymyrecipes.nl.conf

<VirtualHost *:80>
        ServerName mixifymyrecipes.nl
        ServerAlias www.mixifymyrecipes.nl
	DocumentRoot /home/remco/Repositories/MixifyMyRecipes/src/public

        <Directory /home/remco/Repositories/MixifyMyRecipes/src/public>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

	ErrorLog ${APACHE_LOG_DIR}/mixifymyrecipes.nl_error.log
	CustomLog ${APACHE_LOG_DIR}/mixifymyrecipes.nl_access.log combined
</VirtualHost>

# Install laravel files
composer install

# Enable site and modules
sudo a2ensite mixifymyrecipes.nl.conf
sudo a2enmod rewrite
sudo systemctl restart apache2

# Set permissions
sudo chmod o+x /home/remco
sudo chmod o+x /home/remco/Repositories
sudo chmod o+x /home/remco/Repositories/MixifyMyRecipes
sudo chmod o+x /home/remco/Repositories/MixifyMyRecipes/src
sudo chmod o+x /home/remco/Repositories/MixifyMyRecipes/src/public

sudo chown -R "$USER":www-data /home/remco/Repositories/MixifyMyRecipes/src/storage
sudo chown -R "$USER":www-data /home/remco/Repositories/MixifyMyRecipes/src/bootstrap/cache
sudo chmod -R ug+rwx /home/remco/Repositories/MixifyMyRecipes/src/storage
sudo chmod -R ug+rwx /home/remco/Repositories/MixifyMyRecipes/src/bootstrap/cache

# Add site to hosts
sudo nano /etc/hosts

127.0.0.1 mixifymyrecipes.nl

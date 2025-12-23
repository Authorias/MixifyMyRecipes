# Install XAMPP for windows with debugging (XDebug)


##### Download XAMPP from the following url
Url https://www.apachefriends.org/download.html
8.2.12 / PHP 8.2.12

Redirect : https://www.apachefriends.org/download_success.html	


##### Install XAMPP
Install xampp at its default location 'C:\xampp' and with default settings

Create a shortcut on your desktop from 'C:\xampp\xampp-control.exe', name it 'XAMPP' and run as administrator


##### Making site working
Make the desktop link to XAMPP to run as administrator

Run the XAMPP control app

Make sure 'Apache' is running

Open a browser and go to 'http://localhost'

If it all goes well you get redirected too 'http://localhost/dashboard'


##### Install xdebug
Now go to 'http://localhost/dashboard/phpinfo.php'

Select all text on the page, goto 'https://xdebug.org/wizard' and paste the text there to see what xdebug file you need

In my case I needed 'php_xdebug-3.4.7-8.2-ts-vs16-x86_64.dll', rename it to 'php_xdebug.dll'

Place the 'php_xdebug.dll' in the directory 'c:\xampp\php\ext\'

Edit 'C:\xampp\php\php.ini' and add or modify :

*zend_extension = xdebug*

*xdebug.mode=debug*

*xdebug.client_port=9003*

*xdebug.start_with_request=yes*

Restart the apache webserver in XAMPP


##### Debugging in Visual Studio Code
Install the extension 'PHP debug'
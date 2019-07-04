# Start a server and open the browser
Allekok_path=~/projects/www.allekok.com
Browser=firefox
Port=8080

cd $Allekok_path
$Browser http://localhost:$Port/ &
php -S localhost:$Port

# Start a server and open the browser
Allekok_path=~/Projects/allekok.com
Browser=chromium-browser
Port=8080

cd $Allekok_path
$Browser http://localhost:$Port/ &
php -S localhost:$Port

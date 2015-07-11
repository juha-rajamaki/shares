# Tracker app for tracking Oil, Gold, Dax etc. share prices in real time


### Example usage to track certain share
php tracker certfificate/bullolja


### Example of usage of watchdog (track multiple shares)
1. First make watchdog.conf from watchdog.conf.example and watchdog.list from watchdog.list.example (or run make.sh)
2. run the program :

php watchdog


### Example of usage of Daxduck (track DAX-index points)

1. Run the daxduck in konsole to collect data

php daxduck

2. put the data in web ser er port

php -S localhost:9191 daxduck-backend.php

3. open your browser (http://localhost:9191)


## Licence

The MIT License


## Author

Juha Rajamäki (@juha-rajamaki)

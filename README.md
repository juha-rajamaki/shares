# Tracker app for tracking Oil, Gold, etc. share and leverage instruments prices in real time



### Example usage to track certain share

php tracker certfificate/bullolja



### Example of usage of watchdog (track multiple shares)
1. First make watchdog.conf from watchdog.conf.example and watchdog.list from watchdog.list.example (or run make-watchdog-config.sh)
2. run the program :

php watchdog



### Example to check today turbo warrants, minifutures etc 

php today-games



### Example to add turbo warrants and futures to watchdog (creates T-LONGDAX with certain knock price). Note: create "watchdog-daily"- folder first

php createdaily T-LONGDAX-JR-CG 11200



### Example of usage of Legend (show dax price history)

php legend



## Licence

The MIT License


## Author

Juha Rajamäki (@juha-rajamaki)

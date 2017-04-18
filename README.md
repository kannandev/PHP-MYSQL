## PHP-MYSQL
File:class.curl.php
#Use class.curl.php alone for curl functionality
##Function getInstance()
Used for create Object of curl class
##Function get()
Hit a url with Json value and POST Method
Header : Content-Type:application/json
##Function postRawData()
Hit a url with form data and POST method
Header : Content-Type : application/x-www-form-urlencoded
##Function postAuthToken()
Hit a Url with Json data And POST Method
Header : Content-Type:application/json
More Header Option : Add Auth Token,Content-Length

File: class.database.php
#use class.database.php, if you want to use database connectivity and execute query
#Function getInstance()
Used to create object of database
#Function execute()
  Used to execute query and return resoure
#Function fetch()
  Used to fetch the records as object format
  
 File: class.logging.php
 #Function getInstance()
 Used to create object 
 #Function lwrite()
   Used to write the log into log file, Log file path has to be defined at config.php
   755 file permission has to set log.log

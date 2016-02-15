
#University Facility Booking System

#### CONFIGS IN THE CODE:

About *facility.sql*

Import this file into your MySql.

In *application/config/config.php*:

Enter your database credentials in DB_USER, DB_PASS etc.
Enter your project URL into URL, don't forget the trailing slash!
Edit COOKIE_DOMAIN to the above URL

In *.htaccess*:

Change the RewriteBase: when using the script within a sub-folder, put this path here, like */mysubfolder/* !
If your app is in the root of your web folder, then delete this line or comment it out.


## License

Licensed under [MIT](http://www.opensource.org/licenses/mit-license.php). Totally free for private or commercial projects.

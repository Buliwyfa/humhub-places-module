# Places - location

Notice that this module can be used with MySQL >= 5.5, MariaDB >= 5.3.3, and PostgreSQL >= 9.1

MySQL needs to be at least version 5.5 and have the GIS geometry model. This is because this module 
takes advantage of the spatial point data type for faster indexing and distance between point calculations. 
Without this this module could possibly slow down the application. 

I need someone to look up and configure the migration specific for MariaDB and PostgresSQL to take advantage of the
spatial R-Tree data types. I would like to know which version of database and higher. What kind of db table it needs to be 
stored as, and what type of indexing it offeres such as R-tree or B-tree. 

## Installation

**Under Development**.

This module takes advantage of the yii2 spatial repository. A special thanks to sjaakp for creating the spatial ActiveRecord and Active
Query classes. Because this module does take advantage of that  repository it is required that you add the repository to your composer.json 
file. Simply by adding "sjaakp/yii2-spatial": "*" to the file. 

Or you can use the command line. 

$ php composer.phar require sjaakp/yii2-spatial "*"

This module is still under development but currently it can be installed by adding the folder to the modules directory and then clicking the enable link in the admin/module page. This module currently addes the users geoLocation to the database by using googles GeoLocation api and the users address. Because of this the users address, city, state, and zip must be input during the registration process. The module implements the mentioned above automatically. 

To come:
  - Create places that store the place location and information about the place. 
    -Other modules will be able to take advantage of the distance and nearest locations. 
  - List users in a stream by distance from users place. 
     - Would like to implement geoLoacation from the users cell. 
  - Allow specific users to create venues in which they can keep updated with current information about the venue. 
    - Allow slideshow of the venue to be displayed on the venue page. 
  
  - Want to add these option to the Events module I will be creating as well. 
    - So specific users can create events to be held in the comunity attached to their place that they have created. 

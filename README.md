# MVC Framework in PHP

### About this project

This MVC framework is created in PHP by following a Udemy course called **"Object Oriented PHP & MVC"** by *Brad Traversy*. I created a separate repository just for this framework to be used in future project. The full course is in the Learning-MVC-PHP repository.

### What is MVC?

MVC stands for Model, View, and Controller. MVC is basically a design pattern to organize how the back-end of a webpage interacts with the front-end.
* **Model** is what interacts with the database by updating, retrieving, setting, or deleting information.
* **View** is what the user visually sees. The main homepage of a website is from a file called index.php in the main directory. The rest of the pages on a website is in the view folder directory.
* **Controller** is what controls the information from the model(database) to the view(html) by creating a path or connection between them.

### How does this framework work?

1\.  The url is controlled by the .htaccess files. There are 3 .htaccess files; one in the main directory; one in the app directory; one in the public directory.
  * **Main directory** - this .htaccess file rewrites the main url toward the public directory.
  eg. normally to access the webpage, the user would have to go to domain/public/index.php.
  This .htaccess file makes it so that domain/public/index.php is equal to just domain.
  * **App directory** - this .htaccess file blocks users from accessing this directory which is domain/app. The reason why we don't want users to access this directory is because it contains the MVC framework.
  * **Public directory** - this .htaccess file is important for the MVC framework to work. This file directs the whole webpage through index.php in a query saved as a variable to be used by the MVC in PHP.
  eg. $1 is the PHP variable in index.php?url=**$1**.

2\.  The MVC framework is contained in the app directory. In the app directory, there is a config folder than contains the constant variables for the database, names, and paths. The important main folders however are the /models, /views, /controllers, and /libraries. The MVC is required and initiated through /public/index.php.

3\.  The **/libraries** folder contains 3 files; Core.php, Controller.php, and Database.php. These files are basically the brain of the MVC. It is what makes the MVC function; it is the base of the MVC. These files are capitalized because in them are classes which is named the same as the filename, and are also capitalized.
  * **Core.php** - This file is the start of the MVC. it is initiated in public/index.php. This MVC has the url format of /controller/method/parameters. The Core class set default values for the controller, method, and parameters so that when a user inputs an unknown directory, the default is ran. In this case, it would be "Pages". The Core class:
    - gets the url, sanitizes it to remove unwanted characters, and saves it in an array.
    - then it checks to see if the first url path/value(controller), exists in the app/controllers. That's why it is capitalized. If that controller does NOT exist, the default "Pages" is chosen instead for the $currentController. If it does exist, that first url path/value(controller) becomes the $currentController. Then the url[0] is unset and the controller file in /app/controllers which contains a Class that has the same name as its filename is then required and instantiated.
    - after, it checks to see if the second url path/value(method) exists in the required controller Class in /app/controllers. if so, set $currentMethod and unset url[1].
    - then get the last value in the url array and store it in $params.
    - finally, it call the controller Class with its method and parameters in /app/controllers.
  * **Controller.php** - This file contains a class that is extended by the file's classes in /app/controllers. The class has two method functions called model and view.
    - The model method receives a modal name from /app/controllers, then requires and instantiates it.
    - The view method receives the destination or filename and data to be displayed, checks if that destination or filename exists, if so, it requires it which will be displayed on the screen.
  * **Database.php** - This file connects to the database using PDO. This database class is instantiated and used in /app/models.

4\. The **/controllers** folder contains 1 file named Pages.php which is the default controller.
  * Pages.php contains a Page class that extends the base Controller class in /app/libraries which allows it access to the modal and view through the modal and view methods.
  * Pages.php takes data from the database with modal to the view, by using the controller methods.

5\. The **/modals** folder contains files that sends instructions to the database to retrieve or manipulate data.

6\. The **/views** folder contains files that are basically the html of the site. What the user sees.

For every controller file, there is a view folder that contains the html for the webpage.

### To use this MVC Framework
1\. Change config file variables 

2\. Change the main directory .htaccess file rewrite path

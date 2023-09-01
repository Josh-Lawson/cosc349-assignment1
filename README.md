# Online Recipe Management System

## Brief Description

This application is an online recipe management system that makes use of 3 virtual 
machines; a user interface, a database server, and an admin interface.

## VM 1: User Interface

This vm will be repsonsible for running the user web interface of the application, where 
users interact with the system.

Users will be able to:

1. Create an account
2. Log in to their account
3. Search for recipes
4. Create and submit custom recipes


## VM 2: Database Server

This vm will be responsible for data storage. It will use MySQL to host the database that
contains data related to this application.

The database has the following tables:

1. User 
    - Stores information related to the user such as username and password
    - Stores access level of user (user or admin)
3. Ingredient
    - Stores names and identifiers of all ingredients used in the system
4. Recipe
    - Stores information related to the recipe itself such as intructions
5. RecipeIngredient
    - Matches ingredients with recipes using the unique identifiers


## VM 3: Admin Interface

This vm will be responsible for running the admin web interface of the application, 
where administrators interact with the system with a higher level of
privilege than regular users.

Admin will be able to:

1. Create and delete user accounts
2. Create, edit, and delete recipes
3. Approve or deny recipes submitted by users and pending review


## Building and Running the Application

1. Clone the repository to your own local machine
2. Check that you have vagrant installed
    - You can do this by running `$ vagrant --version`
3. If you do not have vagrant installed you can install it here: 
    `https://developer.hashicorp.com/vagrant/downloads?product_intent=vagrant`
4. Make sure you have VirtualBox downloaded on your machine
    - If you do not already have VitualBox, you can download it here:
    `https://www.virtualbox.org/wiki/Downloads`
    - If you are running on arm64 architecture you will need to download the 
    'macOS/ARM64 BETA' version from the test builds (although as this is a 
    developer preview, you may encounter issues):
    `https://www.virtualbox.org/wiki/Testbuilds`
5. From the clones project repository location run: `$ vagrant up`
    - This will automatically start the build process and the application will 
    start runing
6. You can view the web server on your browser by visiting `http://127.0.0.1:8080/`


## Developing and Re-building the application

1. Once the virtual machines are up and running, you can access them by 
    running `$ vagrant ssh <vm-name>`
    - The user interface vm is called 'userinterface'
    - The admin interface vm is called 'admininterface'
    - The database server vm is called 'dbserver'
2. You can stop the vms by running `$ vagrant halt` and remove them by
    running `$ vagrant destroy`
3. After stopping the vms you can start them back up again by running
    `$ vagrant up`
    - You can run `$ vagrant reload` which will have the same effect as 
    stopping then starting the vms.
4. If you make changes to the 'Vagrantfile' you should run `$ vagrant reload`
    for these changes to take effect 
5. If you make changes to the shell scripts or any other provisioning scripts
    that are run by the 'Vagrantfile' you should run `$ vagrant reload --provision`
6. To connect to the MySQL database:
    - ssh into the database server vm
    - Run the 'export MYSQL_PWD= ...' line from the 'build-dbserver-vm.sh' file
    - Run `$ mysql -u root`

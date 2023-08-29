# cosc349-assignment1

This application is an online recipe management system.

There are 3 vms used to run the application:

VM 1: User Interface

This vm will be repsonsible for running the web interface of the application, which includes
the front-end where users interact with the system.

Users will be able to:

1. Create an account
2. Log in to their account
3. Search for recipes
4. Create and share custom recipes
5. Upload reviews and images

VM 2: Database Server

This vm will be responsible for data storage. It will use MySQL to host the database that
contains data related to this application.

The database has the following tables:

// tbc

VM 3: Admin Interface

This vm will be responsible for running the back end of the application and will provide
administrative functionality

Admin will be able to:

1. Create, edit or delete user accounts
2. Create, edit, or delete recipes
3. Create, edit, or delete reviews
4. Add or delete images
5. Approve or delete images and reviews submitted by users and pending review
6. Generate reports (such as most popular recipes)
7. View and respond to user feedback
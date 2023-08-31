# Online recipe management system - COSC349 Assignment 1 - 2023

## Brief Description

This application is an online recipe management system that makes use of 3 virtual 
machines; a user interface, a database server, and an admin interface.

## VM 1: User Interface

This vm will be repsonsible for running the web interface of the application, which includes
the front-end where users interact with the system.

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
    - Stores information realted to the user such as username and password
2. Admin
    - Stores information related to the admin
3. Ingredient
    - Stores names and identifiers of all ingredients used in the system
4. Recipe
    - Stores information related to the recipe itself such as intructions
5. RecipeIngredient
    - Matches ingredients with recipes using the unique identifiers


## VM 3: Admin Interface

This vm will be responsible for running the back end of the application and will provide
administrative functionality

Admin will be able to:

1. Create, edit or delete user accounts
2. Create, edit, or delete recipes
3. Approve or deny recipes submitted by users and pending review
4. Generate reports (such as most popular recipes)

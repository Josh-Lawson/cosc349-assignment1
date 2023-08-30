
create table if not exists User (
    userId int primary key auto_increment,
    name varchar(255) not null,
    username varchar(255) unique,
    password varchar(255) not null,
    createdDate datetime default current_timestamp
);

create table if not exists Admin (
    adminId int primary key auto_increment,
    username varchar(255) unique,
    password varchar(255) not null,
    createdDate datetime default current_timestamp
);

create table if not exists Ingredient (
    ingredientId int primary key auto_increment,
    ingredientName varchar(255) not null
);

create table if not exists Recipe (
    recipeId int primary key auto_increment,
    userId int,
    recipeName varchar(255) not null,
    approved boolean default false,
    instructions text
);

create table if not exists RecipeIngredient (
    recipeId int,
    ingredientId int,
    quantity varchar(50),
    primary key (recipeId, ingredientId),
    foreign key (recipeId) references Recipe(recipeId),
    foreign key (ingredientId) references Ingredient(ingredientId)
);

-- dummy data:

insert into User (name, username, password) values ('john', 'user1', 'password1');
insert into User (name, username, password) values ('bob', 'user2', 'password2');

insert into Admin (username, password) values ('admin1', 'password1');
insert into Admin (username, password) values ('admin2', 'password2');

insert into Ingredient (ingredientName) values ('ingredient1');
insert into Ingredient (ingredientName) values ('ingredient2');
insert into Ingredient (ingredientName) values ('ingredient3');

insert into Recipe (userId, recipeName, description) values (1, 'recipe1', 'description1');
insert into Recipe (userId, recipeName, description) values (1, 'recipe2', 'description2');
insert into Recipe (userId, recipeName, description) values (2, 'recipe3', 'description3');

insert into RecipeIngredient (recipeId, ingredientId, quantity) values (1, 1, '1 cup');
insert into RecipeIngredient (recipeId, ingredientId, quantity) values (1, 2, '2 cups');
insert into RecipeIngredient (recipeId, ingredientId, quantity) values (2, 1, '3 cups');
insert into RecipeIngredient (recipeId, ingredientId, quantity) values (2, 2, '4 cups');
insert into RecipeIngredient (recipeId, ingredientId, quantity) values (3, 1, '5 cups');


-- extra tables for extra features:

-- create table if not exists Review (
--     reviewId int primary key auto_increment,
--     userId int,
--     recipeId int,
--     rating int,
--     reviewText text,
--     approved boolean default false,
--     foreign key (userId) references User(userId),
--     foreign key (recipeId) references Recipe(recipeId)
-- );

-- create table if not exists Image (
--     recipeId int not null,
--     imageNumber int not null,
--     imageURL varchar(255) not null,
--     approved boolean default false,
--     primary key (recipeId, imageNumber),
--     foreign key (recipeId) references Recipe(recipeId)
-- );

-- create table Feedback (
--     feedbackId int primary key auto_increment,
--     userId int,
--     feedback text,
--     foreign key (userId) references User(userId)
-- );
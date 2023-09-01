
create table if not exists User (
    userId int primary key auto_increment,
    name varchar(255) not null,
    username varchar(255) unique,
    password varchar(255) not null,
    role enum('user', 'admin') default 'user',
    createdDate datetime default current_timestamp
);

create table if not exists Ingredient (
    ingredientId int primary key auto_increment,
    ingredientName varchar(512) not null
);

create table if not exists Recipe (
    recipeId int primary key auto_increment UNIQUE,
    userId int,
    recipeName varchar(255) not null,
    instructions text,
    approved boolean default false
    
);

create table if not exists RecipeIngredient (
    recipeId int,
    ingredientId int,
    quantity varchar(50),
    primary key (recipeId, ingredientId),
    foreign key (recipeId) references Recipe(recipeId),
    foreign key (ingredientId) references Ingredient(ingredientId)
);
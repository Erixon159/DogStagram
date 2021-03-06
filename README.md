# Laravel Instagram Project

[Course link](https://www.youtube.com/watch?v=ImtZ5yENzgE)

## New project
You need:
* composer
* nodejs
* npm
* php + extensions
* laravel package

To start a new project, move to the desired directory and write to the console
```
laravel new NameOfTheProject
```

## Start
To start the application, move to the project's directory and write to the console
```
php artisan serve
```
We need Bootstrap, so move to the project's directory and write to the console
```
php artisan ui bootstrap
```
We need Vue.js, so move to the project's directory and write to the console
```
php artisan ui vue
```
We need to install javascript dependencies, so move to the project's directory and write to the console
```
npm install
```
To compile all js and css to minified app.css and app.js, we move to the project's directory and write to the console
```
npm run dev
```
(You may need to update node version to >12)

If the applications is going to store images, we need to create symbolic link between real storage
and accesible part of the application. Move to the project's directory and write to the console
```
php artisan storage:link
```

## Coding
### Authentication
To enable authentication in the laravel version > 5.8, move to the project's directory and write to the console
```
composer require laravel/ui
php artisan ui:auth --views
php artisan ui bootstrap --auth
npm install && npm run dev
```
This will create new views, layouts and enable registration, users, and user roles.

To create basic user tables and password reset, we need to create a new file in the database directory.
This file will be called **database.sqlite** because we are using *sqlite* as our DB engine.
After that we move to the project's directory and write to the console
```
php artisan migrate
```
After this step, we need to restart app.

## Controllers
Controllers are responsible for the hanfling of requests. Use predefined naming and methods to save a lot of time!
Move to the project's directory and write to the console
```
php artisan make:controller ProfilesController
```

## Models
Creating a model means to create Eloquet class representation of DB table. With simple option *-m*, we are creating a migration as well.
Move to the project's directory and write to the console
```
php artisan make:model Profiles -m
```

## User roles
We need to create user roles for correct behavior and priviledges. For this we use policies. 
These policies are tied to the specific Model, therefore it's part of the command. 
Move to the project's directory and write to the console
```
php artisan make:policy ProfilePolicy -m Profile
```

## Pivot tables
Pivot table is a table tha handles many to many relationship. We don't need a model for this so we are just going to create migration.
We can also specify a name of the migration and the name of the table like so. Move to the project's directory and write to the console
```
php artisan make:migration create_profile_user_pivot_table --create profile_user
```

## Emails
For sending emails, we use mailtrap. Laravel can generate nice template for email. We will use it.
Move to the project's directory and write to the console
```
php artisan make:mail NewUserWelcome -m emails.welcome-email
```

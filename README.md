# library-management-site-project-created-with-laravel

This is a library management site project by persian language created with laravel.

این یک پروژه سایت مدیریت کتابخانه به زبان فارسی است که با لاراول ساخته شده است.

[GitHub Link](https://github.com/afattahi1387/library-management-site-project-created-with-laravel)

[Gitlab Link](https://gitlab.com/laravel-projects14/library-site-project-created-with-laravel)

[Project Course Link](https://www.aparat.com/v/5HkNa?playlist=1726399)

## Initial Setup

For Initial Setup, Performance Step by Step:

### install APACHE, PHP, MySQL and Composer

In step 1, install APACHE, PHP, MySQL and Composer. for install APACHE, PHP and MySQL, You Can install **XAMPP** or **Wampserver** or install seperately.

### Clone this Project

For Use this Project, You Should Clone this project.

For Clone this Project from GitHub, You Should Enter this Command in Your Terminal Or Your Command Prompt:

    git clone https://github.com/afattahi1387/library-management-site-project-created-with-laravel

And for Clone This Project from GitLab, Enter This Command:

    git clone https://gitlab.com/laravel-projects14/library-site-project-created-with-laravel

### Install vendor Folder

For Install vendor Folder, First Open Terminal Or Command Prompt in my_codes folder, Then Enter This Command:

    composer install

### Create Database

For Use this Project, You Should Create Database by Name `library_management_site_created_with_laravel`.

If You Want Change Database Name, You Should Change `DB_DATABASE` in `.env` file.

### Create Database Tables with migrations

For Create Tables in Database, You Should Open my_codes folder in Terminal Or Command Prompt, Then Enter This Command:

    php artisan migrate

### Create folders for upload images

For upload images, You should first create folder `uploads` in `public` folder, then create folders by name `books_images`, `writers_images` and `users_images` in `public/images` and `public/uploads` and create `trash_images` folder in `public/images`.

### Add an Admin for working with site

Now You Should Add an Admin for working with site. You can First Register a User, Then Log Out and Change this user `type` field to `admin`.

### Use this project

Now You can Use this project and Use site.

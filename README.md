<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Project developed in september 2022 

Api Developed in Laravel and React, the front end that was used can be found here https://github.com/joohnyfranzen/Thoth-Code-React 


### Application testing requirements

- Laravel 9
- Php 8
- React 18.2
- Yarn 1.2
- This Project Clone
- React Project Clone

### How to inicializate it

1. In the terminal type ```git clone https://github.com/joohnyfranzen/Thoth-Code-Laravel/```
2. Type the command "composer install". It will install all necessary php packages.
3. After installing the dependencies you modify .env.
4. Finally with the command ```php artisan serve``` run the project.
5. Then you clone the React App ```git clone https://github.com/joohnyfranzen/Thoth-Code-React/```
6. Install it dependencies with ```npm install```
7. Start the project with npm start.
8. Have fun.

### About the project

1. Seeing the need to understand the architecture of the laravel framework, I tried to make a REST Api consuming the database of this project in the React project that you can acess up here.

2. In this project I used Axios to consume in React the database.

3. The project itself its a social network, that have authentication with Auth Sanctum, I learned a lot of React by using its framework, there are many useful things inside of it, and its a start for working in a larger project.

### Database:

- Users - Foreign - ( ( 'user_id' on 'real_state ) ( 'user_id' on 'user_profile' ) )
1. name
2. email
3. email_verified_at
4. password

- Post 
1. title
2. slug
3. content
4. user-_id

- Post Comments 
1. coment
2. user_id
3. post_id

### Routes:
```
- _/api/v1

1. User

- _ /users _
[GET] '/user' - INDEX
[GET] '/user/:id' - SHOW
[POST] '/user' - STORE
[PUT] '/user/:id' - UPDATE
[DELETE] '/user/:id' - DELETE

2. Auth

[POST] '/login' - LOGIN

3. Posts

- _ /post _
[GET] '/post' - INDEX
[GET] 'post/:id' - SHOW
[POST] 'post/' - STORE
[PUT] 'post/:id' - UPDATE
[DELETE] 'post/:id' - DELETE

4. Post Comment

_ /postcomment _ 
[GET] '/postcomment' - INDEX
[GET] '/postcomment/:id' - SHOW
[POST] '/postcomment' - STORE
[PUT] '/postcomment/:id' - UPDATE
[DELETE] '/postcomment/:id' - DELETE



```



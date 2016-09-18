#Code-Pad
It is a platform where students use to code online like many competative sites. It is a college competative platform for teacher-student interaction.
Teachers organise events for the students. This improves the skills set of students.

#Installation and Contribution

###Requirements :

1. PHP > 5.6
2. MySQL
3. Composer
4. Laravel > 5.2

###Installation :

Fork and Clone this repo or download it on your local system.

Open composer and run this given command.
```
composer update
```

After updating composer, Rename the file `.env.example` to `.env` manually.

Generate the Application key
```
php artisan key:generate
```

Migrate the database.
```
php artisan migrate
```

Seed the database
```
php artisan db:seed
```

For Login
```
For Student login:
Admission No. : 15cse075
Password : helloworld

For Teacher login:
Email Id : teacher@jssaten.com
Password : helloworld

For SuperAdmin:
Email Id : admin@admin.com
Password : helloworld
```

Run this project on localhost
```
php artisan serve
```

This project will run on this server:
```
http://localhost:8000/
```

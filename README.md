# SIA SOK PHP test task
### Uzdevums programmētajam (PHP)

- Used old own MVC "framework" (which is rewrite and improved due making this task and my skills growing, but there is still a lot of can be changed and improved);
- Database also, bee attached in this repository `sok.sql`;
- Database credentials located in: `application/config/db.php`;
- Routes located in: `application/config/routes.php`;
- Working stack: PHP 8.1, MySQL, HTML and CSS (Bootstrap 5);
- Test user credentials: username - `test` | password `123`;

`As no instructions were provided where I need to do the task (Docker or etc) I have made it in XAMPP`

### If you see 404 error, make sure you have .htaccess with that contain:

```
AddDefaultCharset utf-8

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !=f
RewriteCond %{REQUEST_FILENAME} !=d
RewriteCond %{REQUEST_URI} !^(.*)\.(css|js|jpg|jpeg|png|gif|svg)$ [NC]
RewriteRule ^(.*)$ index.php
php_value default_charset utf-8
AddType 'text/html; charset=utf-8' .html .htm .shtml
```

About adaptive design, I have use bootstrap, hope there will be needed result :)

#### In the task, I used two approaches to solve the main problem, the reference method and the recursive one, you can see it in `application\lib\TreeBuilder`.

### Spent time

- Authorization took about 15 minutes to solve the problem;
- The main task was solved in 30-40 minutes;
- Most of the time, about 2-3 hours, was also spent on rewriting the MVC architecture to demonstrate the quality of the code;
- It also took about 15-30 minutes to mark up the pages with forms;
- The total debug was about 1 hour (where also was problems with `.htaccess`);
- Styling using bootstrap 15-20 minutes;
- And sometime take to comment all methods maybe ~10-20 minutes;

#### Just as there was no information about using off-the-shelf ORMs, I wrote my queries using PDO.

&copy; Tengizs Gusevs 2023

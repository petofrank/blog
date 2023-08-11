# Interview: Symfony blog post

## Task
**Specifications:** <br />
Build a simple blog in PHP Symfony. The blog should contain the following:
- Overview of blog messages with title, description, date, author with email and number of comments
- Blog detail page with title, content, date, an overview of comments with content, author with email and date
- Page to add a blog post with the above data and validation in the form
- Form to add comments
- Nothing else, authentication is not needed.

**Constraints** <br />
- Use a MySQL database
- Use pagination for the overviews
- There is no need to care about frontend, plain HTML is enough
- Write your code as clean and straightforward as possible, feel free to use DDD tactical patterns, if you know how
- Use Doctrine ORM as persistence layer
- Write a readme for local installation

**Expected deliveries**
1. Source code
2. Instructions on how to build and run the application

_________

### How to run

- Build the application:
    - Step 1: `docker build .`
    - Step 2: `docker compose up -d`
    - Step 3: `docker exec -it app_server /bin/bash`
    - Step 4: `php bin/console doctrine:schema:update --force`
    - Step 5: `php bin/console doctrine:fixtures:load`


-  Notes: 
    - database can be accessed locally from using localhost as host name 
    - Pagination is set to 3 elements per page
    - there are no fixtures for comments and posts

   
-  Possible improvements:
    - migrations
    - gitignore
    - translations
    - authorization & authorization
    - ...
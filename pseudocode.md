# PSEUDOCODE FOR SQL HEROES

## API Session with Ian 11/2
 
### What is an API?
    -   Database
        -   MySQL
            -   Create
            -   Read
            -   Update
            -   Delete
    -   API
        -   PHP
    -   React Front End

### What is a schema for a database?
    -   Every table must have an id
        -   primary key (pk)
        -   it's always an int
        -   it's always unique
        -   it increments

## SQL Heroes project
    -   Really only need 5 functions
        -   One for each CRUD function
        -   One to view name, about me, and abilities of a hero

1. Create a Connection to a local Database using PHP and view the database (using PHPMyAdmin)
    -   Link to PHPMyAdmin
2. The supplied superheroes.sql Database file contains create table and insert statements to get you started. (Do not modify the SQL file directly. Use CRUD operations to achieve CRUD)
    -   Connect database at the top of the file
    -   Close connection at the bottom
3. Decide on a minimum of four CRUD operations you wish to implement (at least one operation for Create, Read, Update, & Delete) - document this in your README.md
    -   CREATE a new hero
        -   POST in Postman
        -   Error check for each hero attribute
    -   READ list of all heroes: names, and about me
        -   GET in Postman
    -   UPDATE an ability
        -   PATCH in Postman
        -   Error check for valid input
    -   DELETE an enemy
        -   DELETE in Postman

    -   Each of these are a case inside a switch.

4. In addition to your four chosen CRUD operations, you should also display all superheroes as a list showing their Name and About Me info.
    -   Also be able to READ all Heroes, showing their Name, About Me, and Abilities
        -   GET in Postman
        -   Need to use INNER JOIN, GROUP BY, and GROUP_CONCAT in SQL
    
    -   This is a function that runs inside the IF, but outside the SWITCH.

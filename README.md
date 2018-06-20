Imoto(妹) - Back-end for Simple Applications
========================

Tired of writing back-ends? Drive your application by barely a front-end with Imoto and MySQL.

How To Use The Imoto
-------------------

Say, now we want to build an application that provides a random "Misaka" on some webpage. The following will tell you how to implement this using Imoto.

### 0x00 Configuration 

1. Copy `config.example.php` to `config.php`.
2. Create a database `misaka`.
3. Create a user of MySQL, grant it `SELECT` privilege of database `misaka`.
4. Fill in the user to `config.php`.

### 0x01 You're done!

1. Run Imoto at somewhere, say, `localhost:8000`.
2. Try this: 
   
    ``curl -H "database: misaka"  -H "Content-type: application/json" -X POST -d '"SELECT * FROM `misaka` ORDER BY RAND() LIMIT 1"' localhost:8000``
  

-------------

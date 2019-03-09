<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Setting up database</title>
</head>
<body>
  <h3>Setting up ...</h3>
  <?php
    include_once 'functions.php';
    createTable('members',
    'user VARCHAR(16),
    pass VARCHAR(16),
    INDEX(user(6)) ');

    createTable('messages',
    'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    auth VARCHAR(16),
    recip VARCHAR(16),
    pm CHAR(1),
    time INT UNSIGNED,
    message VARCHAR(4096),
    INDEX(auth(6)),
    INDEX(recip(6))')

    createTable('profies',
    'user VARCHAR(16),
    text VARCHAR(4096),
    INDEX(user(6))');
  ?>
</body>
</html>

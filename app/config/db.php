<?php

// To keep things simple I am hardcoding the database configuration.
// We could load from a .env file, but since I can only use the slim framework, I cannot use another package that would eaily load the .env file
// I could write a .env parser myself, but that would be a lot of work for this exercise

return [
    'host' => 'mysql',
    'port' => 3306,
    'database' => 'penn-entertainment',
    'username' => 'penn',
    'password' => 'secret',
];
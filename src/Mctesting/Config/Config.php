<?php

/** Application config file
 *  Contains variables needed for application
 */

//Database access
define('DB_USER', '');
define('DB_PASS', '');

$dbhost = 'localhost';
$dbname = '';
$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname;
define('DB_DSN', $dsn);

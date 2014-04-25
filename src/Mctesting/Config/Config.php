<?php

/** Application config file
 *  Contains variables needed for application
 */

//Database access
define('DB_USER', 'usermctesting');
define('DB_PASS', 'qsdf');

$dbhost = 'localhost';
$dbname = 'mctesting';
$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname;
define('DB_DSN', $dsn);

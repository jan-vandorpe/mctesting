<?php

/** Application config file
 *  Contains variables needed for application
 */
//Database access
define('DB_USER', 'usermctesting');
define('DB_PASS', 'qsdf');

$dbhost = 'sat07';
$dbname = 'mctesting';
$dbcharset = 'utf8mb4';
$dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=' . $dbcharset;
define('DB_DSN', $dsn);


$standaardBeheerdersWachtwoord = 'Vdab';
define('BEH_PASS', $standaardBeheerdersWachtwoord);
<?php

/** Application config file
 *  Contains variables needed for application
 */

$site = 'MC Testing';
$standaardBeheerdersWachtwoord = 'Vdab';

//Database access
define('DB_USER', 'root');
define('DB_PASS', 'vdab');

$dbhost = 'localhost';
$dbname = 'mctesting';
$dbcharset = 'utf8mb4';
$dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=' . $dbcharset;
define('DB_DSN', $dsn);


define('SITE', $site);
define('BEH_PASS', $standaardBeheerdersWachtwoord);

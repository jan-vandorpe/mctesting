<?php

/** Application config file
 *  Contains variables needed for application
 */

//site naam
$site = 'MC Testing';
//default wachtwoord -- reset wachtwoord wordt hiernaar gereset
$standaardBeheerdersWachtwoord = 'Vdab';

//zet op true voor development omgeving
$development = false;
//Database access
define('DB_USER', 'root');
define('DB_PASS', '');

$dbhost = 'localhost';
$dbname = 'mctesting';
$dbcharset = 'utf8mb4';
$dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=' . $dbcharset;
define('DB_DSN', $dsn);


define('SITE', $site);
define('BEH_PASS', $standaardBeheerdersWachtwoord);
define('DEBUG', $development);

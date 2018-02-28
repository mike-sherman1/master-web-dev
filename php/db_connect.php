<?php 

session_start();

if (isset($_SESSION['user']))
{
$user     = $_SESSION['user'];
$loggedin = TRUE;
}
else $loggedin = FALSE;

$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

$dbhost = 'localhost'; 
$dbname = 'msherman2015';
$dbuser = 'msherman2015';
$dbpass = '5DM474MQd9';

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0)
{
    die('Unable to connect to database [' . $db->connect_error . ']');
}


?>